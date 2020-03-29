<?php 
namespace VirtualRoom\Test;

use VirtualRoom\Controller\vrWebController;
use PHPUnit\Framework\TestCase;

class vrWebControllerTest extends TestCase
{
    public function testActionHandler_WtihGivenID_ReturnNull()
    {
        $controller = new vrWebController();

        $this->assertNull($controller->courseActionHandler('CTB'));
    }
    public function testActionHandler_WithoutID_ReturnNull()
    {
        $controller = new vrWebController();

        $this->assertNull($controller->courseActionHandler());
    }
    public function testGetModules_ReturnArray()
    {
        $controller = new vrWebController();
        $controller->courseActionHandler('CTB');
        $modulesArray=$controller->getModules();

        $this->assertIsArray($modulesArray);
    }
    public function testGetExams_ReturnArray()
    {
        $controller = new vrWebController();
        $controller->courseActionHandler('CTB');
        $examsArray=$controller->getExams();

        $this->assertIsArray($examsArray);
    }
    public function testGetCourses_ReturnArray()
    {
        $controller = new vrWebController();
        $coursesArray =$controller->getCoursesList();
        
        $this->assertIsArray($coursesArray);
    }

    public function testGetModules_WithoutCourse_ReturnEmptay()
    {
        $controller = new vrWebController();
        $controller->courseActionHandler();
        $modulesArray=$controller->getModules();

        $this->assertEmpty($modulesArray);
    }
    public function testGetExams_WithoutCourse_ReturnEmpty()
    {
        $controller = new vrWebController();
        $controller->courseActionHandler();
        $exams=$controller->getExams();

        $this->assertEmpty($exams);
    }
}
?>