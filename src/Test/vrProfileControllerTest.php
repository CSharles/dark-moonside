<?php 

namespace VirtualRoom\Test;

use VirtualRoom\Controller\Admon\vrProfileController;
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../../vendor/autoload.php';
/**Run this test against an empty vrUser table */

class vrProfileControllerTest extends TestCase
{
    public function testGetInitialUser_Return_true()
    {
        $sesion['user']=0;
        $sesion['setup']=true;

        $controller= new vrProfileController();
        $controller->actionHandler($sesion);
        $initialView = $controller->getInitialUserView();
        $this->assertTrue($initialView);
    }
    public function testGetInitialUser_With_UserId_Return_false()
    {
        $sesion['user']=1;
        $sesion['setup']=true;

        $controller= new vrProfileController();
        $controller->actionHandler($sesion);
        $initialView = $controller->getInitialUserView();
        $this->assertFalse($initialView);
    }
  
    public function testGetEditView_Return_true()
    {
        $expectedSesion['user']=1;
        $expectedPost['editView']=true;

        $controller= new vrProfileController();
        $controller->actionHandler($expectedPost);
        $controller->actionHandler($expectedSesion);
        $generalView = $controller->getGeneralView();
        $this->assertFalse($generalView);
    }
    public function testRegistrar_User_Return_false()
    {
        $expectedPost['user']=1;
        $expectedSesion['registrar']=true;

        $controller= new vrProfileController();
        $controller->actionHandler($expectedPost);
        $controller->actionHandler($expectedSesion);
        $generalView = $controller->getGeneralView();
        $initialView = $controller->getInitialUserView();
        $this->assertFalse($generalView);
        $this->assertFalse($initialView);
    }

    public function testCeateAdmin_With_Correct_Values_return_True()
    {
        $euser=['nick'=>'admin$255',
        'name'=>'Juan',
        'lastn'=>'Serio',
        'pwd'=>'admin331040',
        'role'=>'adm',
        'email'=>"admin@value.com"];
        $controller= new vrProfileController();
        $created=$controller->createAdmin($euser);
        $this->assertTrue($created);
    }
    public function testCeateAdmin_With_Wrong_Values_return_False()
    {
        $euser=['nick'=>'admin$255',
        'name'=>'Juan',
        'lastn'=>'Serio',
        'pwd'=>'admin331040',
        'role'=>'adm'];

        $controller= new vrProfileController();
        $created=$controller->createAdmin($euser);

        $this->assertFalse($created);
    }
}