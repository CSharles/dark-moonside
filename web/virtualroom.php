<?php
namespace VirtualRoom\Web;

use VirtualRoom\Controller\vrWebController;

require_once __DIR__.'/../vendor/autoload.php';

//session_start();

//if(isset($_SESSION["user"])){
    $controller = new vrWebController();
    $controller->getHead();
    $controller->getNav();
    $id=isset($_GET["id"])?$_GET["id"]:NULL;
    $controller->courseActionHandler($id);
    $controller->getFooter();
//}
//else{
//    header("Location:Login.html");
//}