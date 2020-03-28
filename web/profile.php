<?php
namespace VirtualRoom\Web;

use VirtualRoom\Controller\Admon\vrProfileController;

require_once __DIR__.'/../vendor/autoload.php';

session_start();

if(isset($_SESSION['user'])){
    $controller= new vrProfileController();

    if (isset($_REQUEST['editView'])||isset($_REQUEST['registrar'])) {
        $controller->actionHandler($_REQUEST);
    }
    if(isset($_SESSION['setup'])){
        $controller->actionHandler($_SESSION);
    }
    if(!$controller->getGeneralView()&&!$controller->getInitialUserView()){
        $controller->createAdmin($_POST);
    }
    if(isset($_SESSION['user']) &&($_SESSION['user']> 0)){
        unset($_SESSION['setup']);
    }

    $controller->renderHeaderAndNav();

    if($controller->getGeneralView()){
        $controller->renderGeneralView($_SESSION['user']);
    }
    elseif($controller->getInitialUserView()){
        $controller->renderInitialAdminView();
    }
    else{
        $controller->renderEditView($_SESSION['user']);
    }

    $controller->renderFooter();
}
else{
    header("Location:adm1nL0g1n.html");
    die(0);
}