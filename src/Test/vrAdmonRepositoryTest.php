<?php 
namespace VirtualRoom\Test;
use VirtualRoom\Repository\vrAdmonRepository;
use VirtualRoom\Repository\pdoWrapper;
use VirtualRoom\Entity\vrCourse;
use VirtualRoom\Entity\vrModule;
use VirtualRoom\Entity\vrLink;
use PHPUnit\Framework\TestCase;


class vrAdmonRepositoryTest extends TestCase
{

    public function testAddCourse_ReturnTrue()
    {
        $course = new vrCourse("CTA");
        $course->setName("Course Test A");
        $pdo=new pdoWrapper();
        $repo= new vrAdmonRepository($pdo);

        $isSaved =$repo->addCourse($course);
        
        $this->assertTrue($isSaved);
    }
    public function testRetriveCourse_WithGivenID_ReturnCourse()
    {
        $aCourse= new vrCourse("CTA");
        $aCourse->setName("Course Test A");
        $aCourse->setActive(FALSE);
        $aCourse->setAddedBy(0);

        $pdo=new pdoWrapper();
        $repo= new vrAdmonRepository($pdo);

        $dbCourse =$repo->getCourseByID("CTA");
        $this->assertEquals($aCourse,$dbCourse);
    }

    public function testRetriveModule_WithGivenID_ReturnModule()
    {
        $aModule= new vrModule();
        $aModule->setName("Module Test A");
        $aModule->setModuleID("MTA101");
        $aModule->setCourseID("CTA");
        $aModule->setAddedBy(0);
        $aModule->setActive(TRUE);
        $repo= new vrAdmonRepository(new pdoWrapper());
        $dbModule =$repo->getModuleByID("MTA101");
        $this->assertEquals($aModule,$dbModule);
    }

    
    public function testRetriveLinks_WithGivenID_ReturnArrayOfLinks()
    {
        $aLink= new vrLink();
        $aLink->setDescription("Link Test A");
        $aLink->setModuleID("MTA101");
        $aLink->setURL("http://www.example.org/linktestA");
        $aLink->setActive(True);
        $aLink->setExam(false);
        $aLink->setAddedBy(0);
        $testLinkArray=[$aLink];

        $repo= new vrAdmonRepository(new pdoWrapper());
        $dbLinks =$repo->getLinksByModuleID("MTA101");

        $this->assertEquals($testLinkArray,$dbLinks);
    }

    public function testRetriveCourse_WithWrongID_ReturnFalse()
    {
        $repo= new vrAdmonRepository(new pdoWrapper());
        $dbCourse =$repo->getCourseByID("CTE");

        $this->assertFalse($dbCourse);
    }
    public function testRetriveModule_with_WrongID_ReturnFalse()
    {
        $repo= new vrAdmonRepository(new pdoWrapper());
        $dbModule =$repo->getModuleByID("MTE101");
        $this->assertFalse($dbModule);
    }
    public function testRetriveLinks_WithWrongID_ReturnFalse()
    {
        $repo= new vrAdmonRepository(new pdoWrapper());
        $links=$repo->getLinksByModuleID("MTE101");
        $this->assertFalse($links);
    }

    public function testAddingModule_WithNotExistingCourse_returnFalse()
    {
        $module= new vrModule();
        $module->setName("Module Test E");
        $module->setModuleID("MTE101");
        $module->setCourseID("CTE");

        $repo= new vrAdmonRepository(new pdoWrapper());
        $dbModule =$repo->addModule($module);
 
        $this->assertFalse($dbModule);
    }  
    public function testAddingModule_WithNotExistingCourse_GiveErrorCode()
    {
        $module= new vrModule();
        $module->setName("Module Test A");
        $module->setModuleID("MTA101");
        $module->setCourseID("CTE");

        $repo= new vrAdmonRepository(new pdoWrapper());
        $repo->addModule($module);
        //error Llave Foranea inexistente
        //$myerror="23503";
        //error LLave Duplicada
        //$myerror2="23505";

        $error= $repo->getError();
 
        $this->assertIsString($error);
    }
    public function testAddingModule_With_duplicated_Id_GiveErrorCode()
    {
        $module= new vrModule();
        $module->setName("Module Test A");
        $module->setModuleID("MTA101");
        $module->setCourseID("CTE");

        $repo= new vrAdmonRepository(new pdoWrapper());
        $repo->addModule($module);
        //error Llave Foranea inexistente
        //$myerror="23503";
        //error LLave Duplicada
        //$myerror2="23505";

        $error= $repo->getError();
 
        $this->assertIsString($error);
    }
    
    public function testAddingModule_WithNotExistingCourse_Give_DBError()
    {
        $module= new vrModule();
        $module->setName("Module Test E");
        $module->setModuleID("MTE101");
        $module->setCourseID("CTE");

        $repo= new vrAdmonRepository(new pdoWrapper());
        $repo->addModule($module);
        $myCode="23503";

        $errCode= $repo->getErrorDb("code");
        $errMesg= $repo->getErrorDb("message");

 
        $this->assertEquals($myCode,$errCode);
        $this->assertIsString($errMesg);
    }  
    public function testAddingLinkWithExistingModuleID_ReturnFalse()
    {
        $link= new vrLink();
        $link->setDescription("Link Test A");
        $link->setModuleID("MTA101");
        $link->setURL("http://www.example.org/linktestA");
        
        $repo=new vrAdmonRepository(new pdoWrapper());
        $dbLink=$repo->addLink($link);
        
        $this->assertFalse($dbLink);
    }


}