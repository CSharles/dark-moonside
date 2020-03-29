<?php
namespace VirtualRoom\Test;

use PHPUnit\Framework\TestCase;
use VirtualRoom\Entity\vrUser;
use VirtualRoom\Repository\pdoWrapper;
use VirtualRoom\Repository\vrUserRepository;

/*run this test against a populated vrUser table 
Remember update last login date after runing them*/
class vrUserRepositoryTest extends TestCase
{
    public function testGetUserbyId_Return_User()
    {
        $repo = new vrUserRepository(new pdoWrapper());
        $expected = new vrUser(1);
        $expected->setName("Juan");
        $expected->setLastname("Serio");
        $expected->setUserName("admin$255");
        $expected->setRole("adm");
        $expected->setLastLogin("2019-09-12");
        $expected->setActive(true);
        $expected->setEmail('admin@value.com');
        
        $isVrUser= $repo->getUserbyId(1);

        $this->assertEquals($expected,$isVrUser);
    }
    public function testGetUserbyId_WithWrongUserId_Return_False()
    {
        $repo = new vrUserRepository(new pdoWrapper());
       
        $isVrUser= $repo->getUserbyId(3);

        $this->assertFalse($isVrUser);
    }

    public function testGetGuidesbyUserId_Return_Array()
    {
        $repo = new vrUserRepository(new pdoWrapper());
        $e_array=["link Test B"=>true,
                "link Test C"=>true,
                "link Test D"=>false,
                "link Test E"=>false];
       
        $array= $repo->getGuidesbyUserId(1);

        $this->assertEquals($e_array,$array);
    }
    public function testGetGuidesbyUserId_WithWrongUserId_Return_False()
    {
        $repo = new vrUserRepository(new pdoWrapper());
       
        $array= $repo->getGuidesbyUserId(3);

        $this->assertFalse($array);
    }

    public function testGetExamsbyUserId_Return_Array()
    {
        $repo = new vrUserRepository(new pdoWrapper());

        $e_array=["Exam Test C"=>true,
        "Exam Test A"=>true,
        "Exam Test B"=>true,
        "Exam Test D"=>false];
       
        $array= $repo->getExamsbyUserId(1);

        $this->assertEquals($e_array,$array);
    }
    public function testGetExamsbyUserId_WithWrongID_Return_False()
    {
        $repo = new vrUserRepository(new pdoWrapper());

        $array= $repo->getExamsbyUserId(3);

        $this->assertFalse($array);
    }
    
    public function testGetCoursesbyUserId_Return_Array()
    {
        $repo = new vrUserRepository(new pdoWrapper());

        $e_array=["cursito Test B"=>true,
        "Curso Test C"=>false,
        "Curso Test D"=>true,
        "Course Test A"=>true];
       
        $array= $repo->getCoursesbyUserId(0);

        $this->assertEquals($e_array,$array);
    }
    public function testGetCoursesbyUserId_WithWrongId_Return_False()
    {
        $repo = new vrUserRepository(new pdoWrapper());
       
        $array= $repo->getCoursesbyUserId(1);

        $this->assertFalse($array);
    }

    public function testGetModulesbyUserId_Return_Array()
    {
        $repo = new vrUserRepository(new pdoWrapper());
        $e_array=["Module Test A"=>true,
        "Module Test B"=>true,
        "Module Test C"=>true,
        "Module Test D"=>false];
       
        $array= $repo->getModulesbyUserId(0);

        $this->assertEquals($e_array,$array);
    }
    public function testGetModulesbyUserId_WithWrongId_Return_False()
    {
        $repo = new vrUserRepository(new pdoWrapper());
        $e_array=["Module Test A"=>true,
        "Module Test B"=>true,
        "Module Test C"=>true,
        "Module Test D"=>false];
       
        $array= $repo->getModulesbyUserId(0);

        $this->assertEquals($e_array,$array);
    }

    public function testGetUserId_WithUser_Return_UserId()
    {
        $repo = new vrUserRepository(new pdoWrapper());
        
        $id= $repo->getUserId("admin$255","admin331040");

        $this->assertEquals(1,$id);
    }
    public function testGetUserId_WithEmail_Return_UserId()
    {
        $repo = new vrUserRepository(new pdoWrapper());
        
        $id= $repo->getUserId("admin@value.com","admin331040");

        $this->assertEquals(1,$id);
    }
    public function testGetUserId_WithWrongUser_Return_0()
    {
        $repo = new vrUserRepository(new pdoWrapper());
        
        $id= $repo->getUserId("admin","admin331040");

        $this->assertEquals(0,$id);
    }
    public function testGetUserId_WithWrongPasword_Return_0()
    {
        $repo = new vrUserRepository(new pdoWrapper());        
        
        $id= $repo->getUserId("admin","admin");

        $this->assertEquals(0,$id);
    }

    public function testHasUsers_return_CountOfUsers()
    {
        $repo = new vrUserRepository(new pdoWrapper());

        $totalUsers=$repo->hasUsers('adm');

        $this->assertIsInt($totalUsers);

        $this->assertEquals(1,$totalUsers);
    }
    public function testUpdateLastLogin_return_true()
    {
        $repo = new vrUserRepository(new pdoWrapper());

        $updated=$repo->updateLastLogin(1);

        $this->assertTrue($updated);
    }
    public function testUpdateLastLogin_WithWrongID_return_false()
    {
        $repo = new vrUserRepository(new pdoWrapper());

        $updated=$repo->updateLastLogin(3);

        $this->assertFalse($updated);
    }
    public function testVerifyUserFirstLogin_return_true()
    {
        $repo = new vrUserRepository(new pdoWrapper());

        $expectedLogin=$repo->verifyUserFirstLogin("admin$255");

        $this->assertTrue($expectedLogin);
    }
    public function testsetFirstLogin_Set_date()
    {
        $expected = new vrUser(1);
        $expected->setName("Juan");
        $expected->setLastname("Serio");
        $expected->setFirstLogin("2019-09-19");
        $expected->setUserName("admin$255");
        $expected->setRole("adm");
        $expected->setLastLogin("2019-09-17");
        $expected->setActive(true);
        $expected->setEmail('admin@value.com');

        $repo = new vrUserRepository(new pdoWrapper());
        $repo->setFirstLogin(1);

        $real= $repo->getUserbyId(1);

        $this->assertEquals($expected,$real);
    }
}