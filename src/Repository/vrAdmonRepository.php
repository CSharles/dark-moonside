<?php
   require __DIR__ ."/../Entity/vrAdmin.php";
   require __DIR__ ."/../Entity/vrCourse.php";
   require __DIR__ ."/../Entity/vrLink.php";
   require __DIR__ ."/../Entity/vrModule.php";
class vrAdmonRepository
{
    protected $pdo;

    public function __construct($user,$pass) 
    {
        //$dbopts = parse_url(getenv('DATABASE_URL'));
        $dbopts=array("host"=>"localhost","port"=>5432,"path"=>"/virtualroom"); 
        $dsn = 'pgsql:
                host=$dbopts["host"];
                port=$dbopts["port"];
                dbname=ltrim($dbopts["path"],"/");
                user=$user;password=$pass';
        try{
           $this->pdo= new PDO($dsn);
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    //Return true if the link was succesuflly added, otherwise false.
    public function addLink($name, $url, $moduleID)
    {
        $statement=$this->pdo->prepare(
            'REPLACE INTO admon."vrLink" ("Description", "URL", "ModuleID") VALUES(?, ?, ?)');
        return $statement->execute([$name, $url, $moduleID]);
    }
    public function addCourse($name, $courseID)
    {
        $statement=$this->pdo->prepare(
            'REPLACE INTO admon."vrCourse" ("Name", "CourseID") VALUES(?, ?)');
        return $statement->execute([$name, $courseID]);
    }
    public function addModule($name,$moduleID, $courseID)
    {
        $statement=$this->pdo->prepare(
            'REPLACE INTO admon."vrModule" ("Name", "ModuleID","CourseID") VALUES(?, ?, ?)');
        return $statement->execute([$name, $moduleID, $courseID]);
    }
    public function getLinksByModuleID($moduleID)
    {
        $statement=$this->pdo->prepare(
            'Select * from admon."vrLink" Where ModuleID=?');
        return $statement->execute([$moduleID]);
    }
    public function getModuleByID($moduleID)
    {
        $statement=$this->pdo->prepare(
            'Select * from admon."vrModule" Where ModuleID=?');
        return $statement->execute([$moduleID]);
        $module = $statement->fetchObject('vrModule');
        return $game;
    }

}


