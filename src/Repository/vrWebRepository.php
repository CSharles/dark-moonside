<?php
namespace VirtualRoom\Repository;

use VirtualRoom\Repository\baseRepository;
use VirtualRoom\Entity\vrCourse;
use VirtualRoom\Entity\vrLink;
use VirtualRoom\Entity\vrModule;
use PDO;
/**
 * The class that represent the access to the database of the client side of the application
 */
class vrWebRepository extends baseRepository
{
    /**
     * Creates a repository that control the access of the data for the Client side of the application
     * @param pdoWrapper $db the database conection
     * @return void
     */
    public function __construct ($db){
        parent::__construct($db);
    }
    /**
     * Return an array with the Name, Id, and Thumbnail of the courses
     * @return Array An array with the courses
     */
    public function getCourses(){
        $sql= 'SELECT "Name", "CourseID", thumbnail FROM client.vrcourse_view';

        return $this->run($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Return a Course with its id, name, thumbnail and the modules
     * @param string $id The id for a course to lookup for
     * @return vrCourse A course with its modules and all its data
     */
    public function getCourseById(string $id){
        $arg=[$id];
        $sql= 'SELECT "Name", "CourseID", thumbnail FROM client.vrcourse_view Where "CourseID"=?';

        $course= $this->run($sql,$arg)->fetchObject(vrCourse::class,[$id]);

        if(!empty($course)){
            $modules=$this->getModulesByCourseId($id);
            $course->setModules($modules);
        }

        return $course;
    }
    /**
     * Return an array of modules with all the guides and exams
     * @param string $id The id for a course to lookup for
     * @return Array Array of modules
     */
    private function getModulesByCourseId(string $id){
        $arg=[$id];
        $sql= 'SELECT * FROM client.get_modules(?)';

        $modules= $this->run($sql,$arg)->fetchAll(PDO::FETCH_CLASS,vrModule::class);

        foreach ($modules as $module) {
            $id = $module->getModuleID();
            $guides=$this->getGuidesByModuleId($id);
            $exams=$this->getExamsByModuleId($id);
            $module->setGuides($guides);
            $module->setExams($exams);
        }

        return $modules;
    }
    /**
     * Return an array of links with their Description and URL
     * @param string $id The id for a module to lookup for
     * @return Array Array of links representing guides
     */    
    private function getGuidesByModuleId(string $id){
        $sql= 'SELECT * FROM client.get_links(?)';
        $arg=[$id];

        return $this->run($sql,$arg)->fetchAll(PDO::FETCH_CLASS,vrLink::class);
    }
    /**
     * Return an array of links with their Description and URL
     * @param string $id The id for a module to lookup for
     * @return Array Array of links representing exams
     */      
    private function getExamsByModuleId(string $id){
        $sql= 'SELECT * FROM client.get_exams(?)';
        $arg=[$id];
        
        return $this->run($sql,$arg)->fetchAll(PDO::FETCH_CLASS,vrLink::class);
    }

}