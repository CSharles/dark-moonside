<?php
namespace VirtualRoom\Controller\Admon;

use VirtualRoom\Controller\baseController;
use VirtualRoom\Repository\vrAdmonRepository;
use VirtualRoom\Repository\pdoWrapper;
use VirtualRoom\Entity\vrCourse;
use VirtualRoom\Entity\vrModule;
use VirtualRoom\Entity\vrLink;
use VirtualRoom\Common\dropboxUploader;

/**
 * Class crontroller for the Admin dashboard view.
 * Control the  admin user and the guides and courses the user create.
 */
class vrAdmonController extends baseController
{
    private $errors;
    private $userId;
    public function __construct($db=NULL){
        if($db===NULL){
            $db = new pdoWrapper();
        }
        $this->repo= new vrAdmonRepository($db);
    }

    public function setUser(int $id=0){
        if ($id== null)
            $id=0;
        $this->userId=$id;
    }
    public function componentHandler(string $componentName=NULL):void{
        switch ($componentName) {
            case 'modules':
                $this->getModuleComponent();
                break;
            case 'guides':
                $this->getGuideComponent();
                break;
            case 'exams':
                $this->getExamComponent();
                break;
            default:
                $this->getCourseComponent();
                break;
        }
    }
    public function deleteActionHandler(array $actionAndId):void{
        if (isset($actionAndId["deleteCourse"])){
            $id = $actionAndId["deleteCourse"];
            if ($id>0) {
                $this->repo->deleteCourseWithId($id);
            }
        }
        if (isset($actionAndId["deleteModule"])){
            $id = $actionAndId["deleteModule"];
            if ($id>0) {
                $this->repo->deleteModuleWithId($id);
            }
        }
        if (isset($actionAndId["deleteLink"])){
            $url = $actionAndId["deleteLink"];
            if ($url<>"") {
               $this->repo->deleteLinkWithUrl($url);
            }
        }
    }
    public function createActionHandler(array $request){
        $sender = $request["sender"];
        switch ($sender) {
            case "course":
                if(isset($request["courseName"],$request["courseId"])){
                    $course = new vrCourse($request["courseId"]);
                    $course->setName($request["courseName"]);
                    $course->setAddedBy($this->userId);
                    
                    //sent to dropbox here
                    if(is_uploaded_file($request["courseThumb"]["tmp_name"]))
                    {
                        $thumb_url= $this->processDropBoxUpload($request["courseThumb"]);

                        $course->setThumbnail($thumb_url);
                    }
                    
                    if(isset($request["isActive"]))
                        $course->setActive(true);
                    else
                        $course->setActive(false);

                    $this->repo->addCourse($course);
                }
                break;
            case "module":
                if(isset($request["moduleName"],$request["moduleId"],$request["courseId"])){
                    $module = new vrModule();
                    $module->setModuleID($request["moduleId"]);
                    $module->setName($request["moduleName"]);
                    $module->setCourseID($request["courseId"]);
                    $module->setAddedBy($this->userId);
                    
                    if(isset($request["isActive"]))
                        $module->setActive(true);
                    else
                        $module->setActive(false);
                    
                    $this->repo->addModule($module);
                }
                break;        
            case "link":
                if(isset($request["guideName"],$request["linkUrl"],$request["moduleId"])){
                    $link = new vrLink();
                    $link->setDescription($request["description"]);
                    $link->setURL($request["linkUrl"]);
                    $link->setModuleID($request["moduleId"]);
                    $link->setAddedBy($this->userId);
                    
                    if(isset($request["isActive"]))
                        $link->setActive(true);
                    else
                        $link->setActive(false);
                    
                    $link->setExam(false);

                    $this->repo->addLink($link);
                }
                break;
            case "exam":
                if(isset($request["description"],$request["linkUrl"],$request["moduleId"])){
                    $link = new vrLink();
                    $link->setDescription($request["description"]);
                    $link->setURL($request["linkUrl"]);
                    $link->setModuleID($request["moduleId"]);
                    $link->setAddedBy($this->userId);

                    if(isset($request["isActive"]))
                        $link->setActive(true);
                    else
                        $link->setActive(false);
                    
                    $link->setExam(true);
                    
                    $this->repo->addLink($link);
                }
                break;                    
            default:
                break;
        }

    }
    public function renderHeaderNavAndAside():void{
        require __DIR__ ."/../../View/adm1nHeader.php";
        require __DIR__ ."/../../View/adm1nNav.php"; 
        require __DIR__ ."/../../View/adm1nAside.php"; 
    }
    public function renderFooter():void{
        require __DIR__ ."/../../View/adm1nFooter.php";
    }

    private function identifyError(string $error){
        if($error=="23505"){
            return "Ya existe este elemento en la base de datos";
        } else{
            return $error;
        }
    }
    private function createTable(string $tableNamme, array $tableHeaders){
        if(!$this->repo->hasError()){
            $data = $this->repo->getDataFromTable($tableNamme, $this->userId);
            if(!$this->repo->hasErrorDb()){
                $tableColName=$tableHeaders;
                $tableView = require __DIR__."/../../Template/vrTableView.php";
            }
            else{
                $data=array();
                $tableColName=array();
                $tableView = include __DIR__."/../../Template/vrTableView.php";
                $errorMessage = $this->identifyError($this->repo->getErrorDb("code"));
                $tableView.= require __DIR__."/../../Template/vrMessagesView.php";
            }
            return $tableView;         
        }
        else{
            $errorMessage = $this->identifyError($this->repo->getError());
            $errorView = require __DIR__."/../../Template/vrMessagesView.php";
            return $errorView;
        }

    }
    private function createComponent(string $component, array $componentHeaders,array $componentControls,array $componentModal){
        $buferedTable="";
        ob_start();
        
        switch ($component) {
            case 'courses':
             $t=$this->getCoursesTable();
                break;
            case 'modules':
             $t=$this->getModulesTable();
                break;
            case 'links':
             $t=$this->getLinksTable();
                break;
            case 'exams':
             $t=$this->getExamsTable();
                break;
        }

        $buferedTable = ob_get_clean();

        $componentView=include __DIR__."/../../Template/adm1ndashb0ardComponent.php";       
    }
    private function getCoursesTable(){
        $Headers=["Nombre","Cod. curso"];
        $table="vrCourse";
        return $this->createTable($table,$Headers);
    }
    private function getModulesTable(){
        $Headers=["Nombre","Cod. Modulo","Cod. Curso"];
        $table="vrModule";
        return $this->createTable($table,$Headers);
    }
    private function getLinksTable(){
        $Headers=["Descripción","Url","Modulo"];
        $table="vrLink";
        return $this->createTable($table,$Headers);

    }
    private function getExamsTable(){
        $Headers=["Descripción","Url","Modulo"];
        $table="vrExam";
        return $this->createTable($table,$Headers);

    }
    private function processDropBoxUpload(array $fileArray):string{
        $path2DropBox= dropboxUploader::doUpload($fileArray["courseThumb"]["tmp_name"], $fileArray["courseThumb"]["name"]);
        $imgUrl=dropboxUploader::createSharedLink($path2DropBox);
        return $imgUrl;
    }
#Region Component Creation
    private function getCourseComponent(){
        $Headers=["Name"=>"Cursos","SubHeader"=>"Administrar los cursos",
        "Description"=>"Vista general de los cursos"];
        $Controls=["Target"=>"#newCourse","DeleteElement"=>"deleteCourse",
        "EditId"=>"editar-curso","DeleteId"=>"eliminar-curso","FormId"=>"deleteForm"];
        $ModalConent=["ModalId"=>"newCourse","ModalTitle"=>"Nuevo curso",
            "view"=>'/../View/Admon/courseModal.php',
            "ModalButton"=>"course"
        ];
        $component="courses";
        return $this->createComponent($component,$Headers,$Controls,$ModalConent);
    }
    private function getModuleComponent(){
        $Headers=["Name"=>"Modulos","SubHeader"=>"Administrar los modulos",
        "Description"=>"Vista general de los modulos"];
        $Controls=["Target"=>"#newModule","DeleteElement"=>"deleteModule",
        "EditId"=>"editar-modulo","DeleteId"=>"eliminar-modulo","FormId"=>"deleteModuleForm"];
        $ModalConent=["ModalId"=>"newModule","ModalTitle"=>"Nuevo Modulo",
            "view"=>'/../View/Admon/moduleModal.php',
            "ModalButton"=>"module"
        ];
        $component="modules";
        return $this->createComponent($component,$Headers,$Controls,$ModalConent);
    }
    private function getGuideComponent(){
        $Headers=["Name"=>"Guias","SubHeader"=>"Administrar las guias",
        "Description"=>"Vista general de las guias"];
        $Controls=["Target"=>"#newLink","DeleteElement"=>"deleteLink",
        "EditId"=>"editar-enlace","DeleteId"=>"eliminar-enlace","FormId"=>"deleteLinkForm"];
        $ModalConent=["ModalId"=>"newLink","ModalTitle"=>"Nueva Guía",
            "view"=>'/../View/Admon/guideModal.php',
            "ModalButton"=>"link"
        ];
        $component="links";
        return $this->createComponent($component,$Headers,$Controls,$ModalConent);
    }
    private function getExamComponent(){
        $Headers=["Name"=>"Examenes","SubHeader"=>"Administrar examenes",
        "Description"=>"Vista de examenes activos"];
        $Controls=["Target"=>"#newLink","DeleteElement"=>"deleteLink",
        "EditId"=>"editar-enlace","DeleteId"=>"eliminar-enlace","FormId"=>"deleteLinkForm"];
        $ModalConent=["ModalId"=>"newLink","ModalTitle"=>"Nuevo enlace","ModalInputCount"=>3,
            "Inputs"=>[
                ["LabelText"=>"Descripcion del enlace","Name"=>"description","Id"=>"link-description","PlaceHolder"=>"Titulo del examen"],
                ["LabelText"=>"URL del enlace","Name"=>"linkUrl","Id"=>"link-url","PlaceHolder"=>"http://wwww.example.com"],
                ["LabelText"=>"Modulo al que pertenece","Name"=>"moduleId","Id"=>"mod-id","PlaceHolder"=>"Id del módulo"]
            ],
            "ModalButton"=>"exam"
        ];
        $component="exams";
        return $this->createComponent($component,$Headers,$Controls,$ModalConent);
    }
#endRegion
}