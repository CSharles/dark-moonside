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
    public function getCoursesTable(){
        if(!$this->repo->hasError()){
            $data = $this->repo->run('select * from admon."vrCourse"');  
            if(!$this->repo->hasErrorDb()){
                $tableView = require __DIR__."/../Template/vrCourseTableView.php";
            }
            else{
                $data=array();
                $tableView = require __DIR__."/../Template/vrCourseTableView.php";
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
    public function getModulesTable(){
        if(!$this->repo->hasError()){
            $data = $this->repo->run('select * from admon."vrModule"');
            if(!$this->repo->hasErrorDb()){       
                //$tableColName= array_keys((array)$data->fetch());
                $tableColName=[0=>"Nombre",1=>"Cod. Modulo",2=>"Cod. Curso"];
                $tableView = require __DIR__."/../Template/vrTableView.php";
            }
            else{
                $data=array();
                $tableColName=array();
                $tableView = require __DIR__."/../Template/vrTableView.php";
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
    public function actionHandler(){
        if (isset($_POST["deleteID"])){
            $borrar = $_POST["deleteID"];
        }
        if(isset($_POST["sender"])){
            $sender = $_POST["sender"];
            switch ($sender) {
                case "course":
                if(isset($_POST["name"],$_POST["courseId"])){
                    $course = new vrCourse($_POST["courseId"]);
                    $course->setName($$_POST["name"]);
                    $this->repo->addCourse($course);
                }
                    break;
                case "module":
                if(isset($_POST["name"],$_POST["moduleId"],$_POST["courseId"])){
                    $module = new vrModule();
                    $module->setModuleID($_POST["moduleId"]);
                    $module->setName($_POST["name"]);
                    $module->setCourseID($_POST["courseId"]);
                    $this->repo->addModule($module);
                }        
                    break;
                case "link":
                if(isset($_POST["description"],$_POST["url"],$_POST["moduleId"])){
                    $link = new vrLink();
                    $link->setDescription($_POST["description"]);
                    $link->setURL($_POST["url"]);
                    $link->setModuleID($_POST["moduleId"]);
                    $this->repo->addLink($link);
                }
                default:
                    break;
            }
        }
    }
}
$controler= new vrAdmonController();
$controler->actionHandler();


?>

