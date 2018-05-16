<?php
require __DIR__."/../Repository/vrAdmonRepository.php";

class vrAdmonController
{
    protected  $repo;
    private $errors;
    public function __construct(){
        $this->repo= new vrAdmonRepository("vrAdmin","vradmin23");
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
    private function identifyError($error){
        if($error["code"]=="23505"){
            return "Ya existe este elemento en la base de datos";
        } else{
            return $error["message"];
        }
    }
    public function addCourse(vrCourse $course){
        $this->repo->addCourse($course);
    }
}
$controler= new vrAdmonController();
if(isset($_POST["name"])&&isset($_POST["courseID"])){
    $course = new vrCourse($_POST["courseID"]);
    $course->setName($_POST["name"]);
    $controler->addCourse($course);
}
if (isset($_POST["deleteID"])){
    $borrar=$_POST["deleteID"];

}
?>

