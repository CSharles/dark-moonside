<?php
namespace VirtualRoom\Controller;

use VirtualRoom\Controller\baseController;
use VirtualRoom\Repository\pdoWrapper;
use VirtualRoom\Repository\vrWebRepository;
/**
 * Control the presentation of data in the Client Side of the application.
 */
class vrWebController extends baseController
{
    /**
     * @var mixed $course Storage the current couse
     */
    private $course;
    /**
     * Creates a controller for the Client side
     * @param pdoWrapper $db the database conection
     * @return void
     */
    public function __construct($db=NULL){
        if ($db===NULL) {
            $db=new pdoWrapper(2);
        }
        $this->repo= new vrWebRepository($db);
    }
    /**
     * Return an array containing all the availables courses with their name, id and thumbnail
     * @return Array Array of course info
     */
    public function getCoursesList(){
        $coursesArray= $this->repo->getCourses();
        return $coursesArray;
    }
    /**
     * Return an array containing all the modules for the current course
     * @return Array Array of modules
     */
    public function getModules(){
        $modules=Array();
        if (isset($this->course))
            $modules=$this->course->getModules();
        return $modules;
    }
    /**
     * Return an array containing all the exams for each module of the current course
     * @return Array Array of exams
     */    
    public function getExams(){
        $exams= array();
        if (isset($this->course)) {
            $modules= $this->getModules();
            if (is_array($modules) && !empty($modules)) {
                foreach($modules as $module){
                    $exams=array_merge($exams,$module->getExams());
                }
            }
        }
        return $exams;
    }
    /**
     * Set or update the current course and user by their respective ids
     * @param string $courseId The course id that will be seted or updated
     * @param int $userId The id of the user that will be seted or updated
     * @return void
     */
    public function courseActionHandler(string $courseId=NULL,int $userId=0){
        if($courseId!=NULL){
            $this->setCourse($courseId);
            $this->showCourseContentView();
        }
        else{
            $this->showCourseListView();
        }
    }
    /**
     * Render the Header part of the client web site
     * @return mixed HTML code for the head
     */
    public function getHead(){
        return require_once __DIR__."/../View/webHead.php";
    }
    /**
     * Render the Nav part of the client web site
     * @return mixed HTML code for the nav
     */    
    public function getNav(){
        return require_once __DIR__."/../View/webNav.html";
    }
    /**
     * Render the Footer part of the client web site
     * @return mixed HTML code for the footer
     */       
    public function getFooter(){
        return require_once __DIR__."/../View/webFooter.php";
    }

    /**
     * Set or update the current course using its id 
     * @param string $id The id of the course that will be set as current course
     * @return void
     */    
    private function setCourse(string $courseId){
        $this->course=$this->repo->getCourseById($courseId);
    }
    private function destroyCourse(){
        unset($this->course);

    }
    /**
     * Show the view of a list with all the courses
     * @return void
     */    
    private function showCourseListView(){
        require_once __DIR__."/../View/webCourseList.php";
    }
    /**
     * Show the view of a page with all the modules and the exams
     * @return void
     */ 
    private function showCourseContentView(){
       $controls=array(
           array("id"=>"#exams","name"=>"Examenes","thumbnail"=>NULL),
           array("id"=>"#modules","name"=>"Guias","thumbnail"=>NULL),
           array("id"=>"#resources","name"=>"Recursos","thumbnail"=>NULL),
           array("id"=>"#misc","name"=>"Miselaneas","thumbnail"=>NULL)
       );
        require_once __DIR__."/../View/webCourseContent.php";
    }
}
