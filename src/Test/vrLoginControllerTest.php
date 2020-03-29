<?php 

namespace VirtualRoom\Test;

require_once __DIR__.'/../../vendor/autoload.php';

use VirtualRoom\Controller\Admon\vrLoginController;

use PHPUnit\Framework\TestCase;

class vrLoginControllerTest extends TestCase
{
    public function testLogin_User_FirstTime_return_2()
    {
        //mock loginRepository
        $mockRepo= $this->getMockBuilder('vrUserRepository')->
        setMethods(['verifyUserFirstLogin','getUserId','hasUsers'])->getMock();

        //mock verifyUserFirstLogin method
        $mockRepo->expects($this->once())->method('verifyUserFirstLogin')
        ->will($this->returnValue(TRUE));
        //mock getUserId method
        $mockRepo->expects($this->once())->method('getUserId')
        ->will($this->returnValue(1));
        //mock hasUsers method
        $mockRepo->expects($this->once())->method('hasUsers')
        ->will($this->returnValue(TRUE));

        //send json user and password
        $mocklogin=['user'=>"admin",'password'=>"pass"];
        $logdata=json_encode($mocklogin);

        $controller= new vrLoginController($mockRepo);
        $result=$controller->actionHandler($logdata);
        //asert
        $this->assertEquals(2,$result);
    }

    public function testLogin_First_User_return_3()
    {
        //mock loginRepository
        $mockRepo= $this->getMockBuilder('vrUserRepository')->
        setMethods(['hasUsers'])->getMock();

        //mock hasUsers method
        $mockRepo->expects($this->once())->method('hasUsers')
        ->will($this->returnValue(FALSE));

        //send json user and password
        $mocklogin=['user'=>"admin",'password'=>"pass"];
        $logdata=json_encode($mocklogin);

        $controller= new vrLoginController($mockRepo);
        $result=$controller->actionHandler($logdata);
        //asert
        $this->assertEquals(3,$result);
    }

    public function testLogin_Recurent_User_return_true()
    {
        //mock loginRepository
        $mockRepo= $this->getMockBuilder('vrUserRepository')->
        setMethods(['verifyUserFirstLogin','getUserId','hasUsers'])->getMock();

        //mock verifyUserFirstLogin method
        $mockRepo->expects($this->once())->method('verifyUserFirstLogin')
        ->will($this->returnValue(FALSE));
        //mock getUserId method
        $mockRepo->expects($this->once())->method('getUserId')
        ->will($this->returnValue(1));
        //mock hasUsers method
        $mockRepo->expects($this->once())->method('hasUsers')
        ->will($this->returnValue(TRUE));

        //send json user and password
        $mocklogin=['user'=>"admin",'password'=>"pass"];
        $logdata=json_encode($mocklogin);

        $controller= new vrLoginController($mockRepo);
        $result=$controller->actionHandler($logdata);
        //asert
        $this->assertTrue($result);
    }
}