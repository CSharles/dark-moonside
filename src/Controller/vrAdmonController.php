<?php
require __DIR__."/../Repository/vrAdmonRepository.php";

class vrAdmonController
{
    protected  $repo;
    private $errors;
    public function __construct(){
        $this->repo= new vrAdmonRepository("vrAdmin","vradmin23");
    }
    public function getTable(){
        if(!$this->repo->hasError()){
            $data = $this->repo->run('select * from admon."vrCourse"');
            $tableView = require __DIR__."/../Template/vrCourseTableView.php";
            if($this->repo->hasErrorDb()){
                $errorMessage = identifyError($this->repo->getErroDb());
                $tableView.= require __DIR__."/../Template/vrMessagesView.php";
            }
            return $tableView;       
        }
        else{
            $errorMessage = identifyError($this->repo->getError());
            $errorView = require __DIR__."/../Template/vrMessagesView.php";

        }
    }
    private function identifyError($error){
        $error["code"];
        if($error["code"]=="23505"){
            return "Ya existe este elemento en la base de datos";
        } else{
            return $error["message"];
        }
    }
    public function editCourse(vrCourse $course){
        
    }
}
$controler= new vrAdmonController();
if(isset($_POST["name"])&&isset($_POST["courseID"])){
    $course = new vrCourse($_POST["courseID"]);
    $course->setName($_POST["name"]);
    $this->repo->addCourse($course);
}
?>

