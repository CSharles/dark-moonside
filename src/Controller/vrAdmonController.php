<?php
require __DIR__."/../Repository/vrAdmonRepository.php";

class vrAdmonController
{
    protected  $repo;
    public function __construct(){
        $this->repo= new vrAdmonRepository("vrAdmin","vradmin23");
    }
    public function getTable(){
        if(!$this->repo->hasError()){
            $data = $this->repo->run('select * from admon."vrCourse"');
            $table = require __DIR__."/../Template/vrCourseTableView.php";
            if($this->repo->hasErrorDb()){
                $errorCode=$this->repo->getErrorDb("code");
                $errorMessage=$this->repo->getErrorDb("message");
                $table.= require __DIR__."/../Template/vrCourseTableMessagesView.php";
            }
            return $table;       
        }
    }
}
?>