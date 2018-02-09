<?php
   require __DIR__ ."/../Entity/vrAdmin.php";
   require __DIR__ ."/../Entity/vrCourse.php";
   require __DIR__ ."/../Entity/vrLink.php";
   require __DIR__ ."/../Entity/vrModule.php";
class vrAdmonRepository
{
   protected $pdo;

    public function __construct($user=NULL,$pass=NULL) 
    {
        //$dbopts = parse_url(getenv('DATABASE_URL'));
        $dbopts=array("host"=>"localhost","port"=>5432,"path"=>"/virtualroom"); 
        $dsn = 'pgsql:
                host='.$dbopts["host"].';
                port='.$dbopts["port"].';
                dbname='.ltrim($dbopts["path"],"/");
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        //$options = array_replace($default_options, $options);
        //parent::__construct($dsn, $username, $password, $default_options);    
           $this->pdo= new PDO($dsn,$user,$pass,$default_options);
    }
    //Return true if the link was succesuflly added, otherwise false.
    public function addLink($link)
    {
        $statement=$this->pdo->prepare(
            'INSERT INTO admon."vrLink" ("Description", "URL", "ModuleID") VALUES(?, ?, ?)');
        return $statement->execute([$link->getDescription(), $link->getURL(), $link->getModuleID()]);
    }
    public function addCourse($course)
    {
        $statement=$this->pdo->prepare(
            'INSERT INTO admon."vrCourse" ("Name", "CourseID") VALUES(?, ?)');
        return $statement->execute([$course->getName(), $course->getCourseID()]);
    }
    public function addModule($module)
    {
        $statement=$this->pdo->prepare(
            'INSERT INTO admon."vrModule" ("Name", "ModuleID", "CourseID") VALUES(?, ?, ?)');
        return $statement->execute([$module->getName(), $module->getModuleID(), $module->getCourseID()]);
    }
    //getters
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
    private function run($sql, $args = NULL)
    {
        if (!$args)
        {
             return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
    public function getCourseData($courseID)
    {
        
    }

}


