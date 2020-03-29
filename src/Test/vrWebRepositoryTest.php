<?php
namespace VirtualRoom\Test;

use VirtualRoom\Repository\vrWebRepository;
use VirtualRoom\Repository\pdoWrapper;
use VirtualRoom\Entity\vrCourse;
use VirtualRoom\Entity\vrModule;
use VirtualRoom\Entity\vrLink;
use PHPUnit\Framework\TestCase;


class vrWebRepositoryTest extends TestCase
{
    public function testGetCourses_ReturnArray()
    {
        $repo = new vrWebRepository(new pdoWrapper(2));
        $courses = $repo->getCourses();
        
        $this->assertIsArray($courses);
    }
    public function testGetExam_WithGivenID_ReturnArray()
    {
        $repo = new vrWebRepository((new pdoWrapper(2)));
        $exams= $this->invokeMethod($repo,"getExamsByModuleId",['MTB101']);
        
        $this->assertIsArray($exams);
    }
    public function testGetLinks_WithGivenID_ReturnArray()
    {
        $repo = new vrWebRepository((new pdoWrapper(2)));
        $links= $this->invokeMethod($repo,"getGuidesByModuleId",['MTA101']);
        
        $this->assertIsArray($links);
    }
    public function testGetModules_WithGivenID_ReturnArray()
    {
        $repo = new vrWebRepository((new pdoWrapper(2)));
        $modules= $this->invokeMethod($repo,"getModulesByCourseId",['CTA']);
        $this->assertIsArray($modules);
    }

    public function testGetCourses_ReturnWithExpectedValues()
    {
        $expectedArray =Array(["Name"=>"cursito Test B","CourseID"=>"CTB","thumbnail"=>NULL],
                              ["Name"=>"Curso Test D","CourseID"=>"CTD","thumbnail"=>NULL]);

        $repo = new vrWebRepository(new pdoWrapper(2));
        $courses = $repo->getCourses();
        
        $this->assertEquals($expectedArray,$courses);
    }
    public function testGetExam_WithGivenID_ReturnWithExpectedValues()
    {
        $exam=new vrLink();
        $exam->setDescription("Primer Examen Teorico CTA");
        $exam->setURL("http://www.examen.test");
        $expectedArray=Array($exam);
        
        $repo = new vrWebRepository((new pdoWrapper(2)));
        $links= $this->invokeMethod($repo,"getExamsByModuleId",['MTB101']);
        
        $this->assertEquals($expectedArray,$links);
    }
    public function testGetLinks_WithGivenID_ReturnWithExpectedValues()
    {
        $link=new vrLink();
        $link->setDescription("Link Test A");
        $link->setURL("http://www.example.org/linktestA");
        $link->setExam(false);
        $expectedArray=Array($link);
        
        $repo = new vrWebRepository((new pdoWrapper(2)));
        $links= $this->invokeMethod($repo,"getGuidesByModuleId",['MTA101']);
        
        $this->assertEquals($expectedArray,$links);
    }
    public function testGetModules_WithGivenID_ReturnWithExpectedValues()
    {
        $moduleA = new vrModule();
        $moduleB = new vrModule();
        $moduleC = new vrModule();
        $moduleA->setName("Module Test A");
        $moduleA->setModuleID("MTA101");
        $moduleA->setExams(Array());
        $link=new vrLink();
        $link->setDescription("Link Test A");
        $link->setURL("http://www.example.org/linktestA");
        $link->setExam(false);
        $moduleA->setGuides(Array($link));
        
        $moduleB->setName("Module Test B");
        $moduleB->setModuleID("MTB101");
        $exam= new vrLink();
        $exam->setDescription("Primer Examen Teorico CTA");
        $exam->setURL("http://www.examen.test");
        $moduleB->setExams(Array($exam));
        $moduleB->setGuides(Array());

        $moduleC->setName("Module Test C");
        $moduleC->setModuleID("MTC101");
        $moduleC->setExams(Array());
        $moduleC->setGuides(Array());
        
        $expectedArray=Array($moduleA,$moduleB,$moduleC);
        
        $repo = new vrWebRepository((new pdoWrapper(2)));
        $modules= $this->invokeMethod($repo,"getModulesByCourseId",['CTA']);
        
        $this->assertEquals($expectedArray,$modules);
    }
    public function testGetCourse_WithGivenID_ReturnWithExpectedValues(){
        $course= new vrCourse("CTB");
        $course->setName("cursito Test B");
        $course->setModules(Array());
        
        $repo= new vrWebRepository(new pdoWrapper(2));
        $c=$repo->getCourseById('CTB');

        $this->assertEquals($course,$c);
    }

    public function testGetCourse_WithWrongID_ReturnFalse(){      
        $repo= new vrWebRepository(new pdoWrapper(2));
        $c=$repo->getCourseById('CTF');

        $this->assertFalse($c);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}
?>