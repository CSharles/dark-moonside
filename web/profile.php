<?php
namespace VirtualRoom\Web;

use VirtualRoom\Controller\Admon\vrProfileController;

require_once __DIR__.'/../vendor/autoload.php';

session_start();

$controller= new vrProfileController();
if (isset($_POST['editView'])||isset($_POST['registrar'])) {
    $controller->actionHandler($_POST);
}
if(isset($_SESSION['setup'])){
    $controller->actionHandler($_SESSION);
}
if(!$controller->getGeneralView()&&!$controller->getInitialUserView()){
    $userdata=['nick'=>$_POST['username'],
    'pwd'=>$_POST['password'],
    'name'=>$_POST['name'],
    'lastn'=>$_POST['lastname'],
    'role'=>$_POST['role'],
    'email'=>$_POST['email']
    ];
    $controller->createUser($userdata);
}
if(isset($_SESSION['user']) && $_SESSION['user']> 0){
    unset($_SESSION['setup']);
}
if($_SESSION['user']){
    
    require_once __DIR__."/../src/View/adm1nHeader.php";
    require_once __DIR__."/../src/View/adm1nNav.php";
    if($controller->getGeneralView()){
        require_once __DIR__."/../src/View/adm1nAside.php";
        require_once __DIR__."/../src/View/adm1nProfileBody.php";
    }
    else{
        if($controller->getInitialUserView()){
            require_once __DIR__."/../src/View/initialAdm1nProfile.php";
        }
        else{
            require_once __DIR__."/../src/View/editAdm1nProfileBody.php";
        }
    }
    require_once __DIR__."/../src/View/adm1nFooter.php";
}
else{
    header("Location:adm1nL0g1n.html");
}