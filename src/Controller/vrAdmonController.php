<?php
require __DIR__."/../Repository/vrAdmonRepository.php";

class vrAdmonController
{
    protected  $repo;
    private $errors;
    public function __construct(){
        $this->repo= new vrAdmonRepository("vrAdmin","vradmin23");
    }
    private function identifyError($error){
        if($error["code"]=="23505"){
            return "Ya existe este elemento en la base de datos";
        } else{
            return $error["message"];
        }
    }
    private function createTable(string $tableNamme, array $tableHeaders ){
        if(!$this->repo->hasError()){
            $data = $this->repo->getDataFromTable($tableNamme);
            if(!$this->repo->hasErrorDb()){       
                $tableColName=$tableHeaders;
                $tableView = require __DIR__."/../Template/vrTableView.php";
            }
            else{
                $data=array();
                $tableColName=array();
                $tableView = include __DIR__."/../Template/vrTableView.php";
                $errorMessage = $this->identifyError($this->repo->getErrorDb());
                $tableView.= require __DIR__."/../Template/vrMessagesView.php";
            }
            return $tableView;         
        }
        else{
            $errorMessage = $this->identifyError($this->repo->getError());
            $errorView = require __DIR__."/../Template/vrMessagesView.php";
            return $errorView;
        }

    }
    private function createComponent(string $component, array $componentHeaders,array $componentControls,array $componentModal){
        $buferedTable="";
        ob_start();
        switch ($component) {
            case 'course':
            $t=$this->getCoursesTable();
                break;
            case 'module':
            $t=$this->getModulesTable();
                break;
            case 'link':
            $t=$this->getLinksTable();
                break;
        }
        $buferedTable = ob_get_clean();
        $componentView=include __DIR__."/../Template/adm1ndashb0ardComponent.php";       
    }
    public function getCoursesTable(){
        $Headers=["Nombre","Cod. Curso"];
        $table="vrCourse";
        return $this->createTable($table,$Headers);
    }
    public function getModulesTable(){
        $Headers=["Nombre","Cod. Modulo","Cod. Curso"];
        $table="vrModule";
        return $this->createTable($table,$Headers);
    }
    public function getLinksTable(){
        $Headers=["Descripción","Url","Modulo"];
        $table="vrLink";
        return $this->createTable($table,$Headers);

    }
    public function actionHandler(){
        if (isset($_POST["deleteCourse"])){
            $id = $_POST["deleteCourse"];
            $this->repo->deleteCourseWithId($id);
        }
        if (isset($_POST["deleteModule"])){
            $id = $_POST["deleteModule"];
            $this->repo->deleteModuleithId($id);
        }
        if (isset($_POST["deleteLink"])){
            $url = $_POST["deleteLink"];
            $this->repo->deleteLinkWithUrl($url);
        }
        if(isset($_POST["sender"])){
            $sender = $_POST["sender"];
            switch ($sender) {
                case "courses":
                if(isset($_POST["courseName"],$_POST["courseId"])){
                    $course = new vrCourse($_POST["courseId"]);
                    $course->setName($_POST["courseName"]);
                    if(isset($_POST["isActive"]))
                        $course->setActive(true);
                    else
                        $course->setActive(false);
                    $this->repo->addCourse($course);
                }
                    break;
                case "modules":
                if(isset($_POST["name"],$_POST["moduleId"],$_POST["courseId"])){
                    $module = new vrModule();
                    $module->setModuleID($_POST["moduleId"]);
                    $module->setName($_POST["name"]);
                    $module->setCourseID($_POST["courseId"]);
                    $module->setActive($_POST["isActive"]);
                    $this->repo->addModule($module);
                }        
                    break;
                case "links":
                if(isset($_POST["description"],$_POST["url"],$_POST["moduleId"])){
                    $link = new vrLink();
                    $link->setDescription($_POST["description"]);
                    $link->setURL($_POST["linkUrl"]);
                    $link->setModuleID($_POST["moduleId"]);
                    $link->setActive($_POST["isActive"]);
                    $this->repo->addLink($link);
                }
                default:
                    break;
            }
        }
    }
    public function getCourseComponent(){
        $Headers=["Name"=>"Cursos","SubHeader"=>"Administrar los cursos",
        "Description"=>"Vista general de los cursos"];
        $Controls=["Target"=>"#newCourse","DeleteElement"=>"deleteCourse",
        "EditId"=>"editarCurso","DeleteId"=>"eliminarCurso","FormId"=>"deleteForm"];
        $ModalConent=["ModalId"=>"newCourse","ModalTitle"=>"Nuevo curso","ModalInputCount"=>2,
        "Inputs"=>[
            ["LabelText"=>"Nombre del curso","Name"=>"courseName","Id"=>"course-name","PlaceHolder"=>"Nombre del curso"],
            ["LabelText"=>"Id del curso","Name"=>"courseId","Id"=>"course-id","PlaceHolder"=>"Id del curso"]
        ],
        "ModalButton"=>"course"];
        $component="courses";
        return $this->createComponent($component,$Headers,$Controls,$ModalConent);
    }
    public function getModuleComponent(){
        $Headers=["Name"=>"Modulos","SubHeader"=>"Administrar los modulos",
        "Description"=>"Vista general de los modulos"];
        $Controls=["Target"=>"#newModule","DeleteElement"=>"deleteId","EditId"=>"editar-modulo","DeleteId"=>"eliminar-modulo","FormId"=>"deleteModuleForm"];
        $ModalConent=["ModalId"=>"newModule","ModalTitle"=>"Nuevo Modulo","ModalInputCount"=>3,
        "Inputs"=>[
            ["LabelText"=>"Nombre del modulo","Name"=>"name","Id"=>"module-name","PlaceHolder"=>"Nombre del curso"],
            ["LabelText"=>"Código del modulo","Name"=>"moduleId","Id"=>"module-id","PlaceHolder"=>"Código del modulo"],
            ["LabelText"=>"Curso al que pertenece","Name"=>"courseId","Id"=>"course-id","PlaceHolder"=>"Código del curso"]
        ],
        "ModalButton"=>"module"];
        $component="modules";
        return $this->createComponent($component,$Headers,$Controls,$ModalConent);
    }
}
$controler= new vrAdmonController();
$controler->actionHandler();
?>

