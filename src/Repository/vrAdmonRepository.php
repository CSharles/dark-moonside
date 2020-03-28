<?php
namespace VirtualRoom\Repository;

use VirtualRoom\Repository\baseRepository;
use VirtualRoom\Entity\vrCourse;
use VirtualRoom\Entity\vrLink;
use VirtualRoom\Entity\vrModule;
use \PDO;
use \PDOException;

class vrAdmonRepository extends baseRepository
{
    public function __construct($db) 
    {
        parent::__construct($db);
    }

    //Return true if the link was succesuflly added, otherwise false.
    public function addLink(vrLink $link)
    {
        try{
            $statement=$this->pdo->prepare(
                'INSERT INTO admon."vrLink" ("Description", "URL", "ModuleID", "Active","Exam", "AddedBy")
                 VALUES(:d, :u, :mid, :act, :e, :usr)
                 ON CONFLICT ("Description","URL") 
                 DO UPDATE
                 SET "Description"= :d, "URL" = :u, "ModuleID" = :mid, "Active"= :act, "Exam"= :e, "AddedBy"= :usr');
                 
            return $statement->execute([$link->getDescription(), $link->getURL(), $link->getModuleID(), 
            $link->isActive()?1:0,$link->isExam()?1:0,$link->getAddedBy()]);
        }
        catch(PDOException $e)
        {
            $this->fillError($e);
            return false;
        }
    }
    public function addCourse(vrCourse $course)
    {
        try{
            $statement=$this->pdo->prepare(
                'INSERT INTO admon."vrCourse" ("Name","CourseID","Active","AddedBy") 
                VALUES(:n, :id, :act, :usr)
                ON CONFLICT ("CourseID") 
                DO UPDATE 
                SET "Name" = :n, "Active"=:act');
            return $statement->execute([$course->getName(), $course->getCourseID(),$course->isActive()?1:0,
            $course->getAddedBy()]);
        }
        catch(PDOexception $e){
            $this->fillError($e);
            return false;
        }
    }
    public function addModule(vrModule $module)
    {
        try{
            $statement=$this->pdo->prepare(
                'INSERT INTO admon."vrModule" ("Name","ModuleID","CourseID","Active","AddedBy") 
                VALUES(:n, :mid, :cid, :act, :usr)
                ON CONFLICT ("ModuleID")
                DO UPDATE
                SET "Name"= :n, "CourseID"= :cid, "Active"= :act');
            return $statement->execute([$module->getName(), $module->getModuleID(), $module->getCourseID(), 
            $module->isActive()?1:0, $module->getAddedBy()]);
        }
        catch(PDOexception $e){
            $this->fillError($e);
            return false;
        }
    }
    public function deleteCourseWithId(int $id){
        try{
            $statement=$this->pdo->prepare(
                'UPDATE admon."vrCourse" SET deleted= true
                WHERE "CourseID"=:id');
           return $statement->execute([$id]);
        }
        catch(PDOexception $e){
            $this->fillError($e);
            return false;
        }
    }
    #region getters
    public function getLinksByModuleID($moduleID)
    {
        $statement=$this->pdo->prepare(
            'Select * from admon."vrLink" Where "ModuleID"=?');
        $statement->execute([$moduleID]);
        $arrayOfLinks= $statement->fetchAll(PDO::FETCH_CLASS,vrLink::class);
        if(empty($arrayOfLinks))
            $arrayOfLinks=false;
        return $arrayOfLinks;
    }
    public function getModuleByID($moduleID)
    {
        $statement=$this->pdo->prepare('Select * from admon."vrModule" Where "ModuleID"=?');
        $statement->setFetchMode(PDO::FETCH_CLASS,vrModule::class);
        $statement->execute([$moduleID]);
        return $statement->fetchObject(vrModule::class);
    }
    public function getCourseByID($courseID)
    {
        $statement=$this->pdo->prepare(
            'Select * from admon."vrCourse" WHERE "CourseID" LIKE ?');
        $statement->setFetchMode(PDO::FETCH_CLASS, vrCourse::class);
        $statement->execute([$courseID]);
        return $statement->fetchObject(vrCourse::class,[$courseID]);
    }
    #endregion


    Public function getDataFromTable(string $tableName, int $userId){
        $columns="";
        $conditions='"Active" =true AND "AddedBy"='.$userId;
        switch ($tableName) {
            case 'vrCourse':
                $columns='"Name", "CourseID"';
                break;
            case 'vrModule':
                $columns='"Name", "ModuleID", "CourseID"';
                break;
            case 'vrLink':
                $columns='"Description", "URL", "ModuleID"';
                $conditions='"Active"=true AND "Exam"=false';
                break;
            case 'vrExam':
                $columns='"Description", "URL", "ModuleID"';
                $conditions='"Exam"=true';
                $tableName='vrLink';
                break;
            default:
                $columns="1";
                break;
        }
        $data = $this->run('select '.$columns.' FROM admon."'.$tableName.'"
                     WHERE'.$conditions);
        return $data->fetchAll();
    }
}


