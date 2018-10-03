<?php
   require __DIR__ ."/../Entity/vrCourse.php";
   require __DIR__ ."/../Entity/vrLink.php";
   require __DIR__ ."/../Entity/vrModule.php";
class vrAdmonRepository extends baseRepository
{
    public function __construct() 
    {
        parent::__construct();
    }

    //Return true if the link was succesuflly added, otherwise false.
    public function addLink(vrLink $link)
    {
        $statement=$this->pdo->prepare(
            'INSERT INTO admon."vrLink" ("Description", "URL", "ModuleID", "Active", "Exam") VALUES(:desc, :url, :moduleid, :active, :exam)');
        return $statement->execute([$link->getDescription(), $link->getURL(), $link->getModuleID(), $link->isActive()?1:0,$link->isExam()?1:0]);
    }
    public function addCourse(vrCourse $course)
    {
        try{
            $statement=$this->pdo->prepare(
                'INSERT INTO admon."vrCourse" ("Name", "CourseID","Active") VALUES(:name, :id, :active)
                ON CONFLICT ("CourseID") DO UPDATE SET "Name" = :name, "Active"=:active');
            return $statement->execute([$course->getName(), $course->getCourseID(),$course->isActive()?1:0]);
        }
        catch(PDOexception $e){
            $this->fillError($e);
        }
    }
    public function addModule(vrModule $module)
    {
        try{
            $statement=$this->pdo->prepare(
                'INSERT INTO admon."vrModule" ("Name", "ModuleID", "CourseID","Active") VALUES(?, ?, ?, ?)');
            return $statement->execute([$module->getName(), $module->getModuleID(), $module->getCourseID(), $module->isActive()?1:0]);
        }
        catch(PDOexception $e){
            throw $e;
            $this->fillError($e);
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
        }
    }
    #region getters
    public function getLinksByModuleID($moduleID)
    {
        $statement=$this->pdo->prepare(
            'Select * from admon."vrLink" Where "ModuleID"=?');
        $statement->execute([$moduleID]);
        return $statement->fetchAll(PDO::FETCH_CLASS,'vrLink');
    }
    public function getModuleByID($moduleID)
    {
        $statement=$this->pdo->prepare('Select * from admon."vrModule" Where "ModuleID"=?');
        $statement->setFetchMode(PDO::FETCH_CLASS,'vrModule');
        $statement->execute([$moduleID]);
        return $statement->fetchObject('vrModule');
    }
    public function getCourseByID($courseID)
    {
        $statement=$this->pdo->prepare(
            'Select * from admon."vrCourse" WHERE "CourseID" LIKE ?');
        $statement->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'vrCourse');
        $statement->execute([$courseID]);
        $course = $statement->fetchObject('vrCourse',[$courseID]);
        return $course;
    }
    #endregion


    Public function getDataFromTable(string $tableName){
        $columns="";
        $conditions='"Active" =true';
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


