<?php
namespace VirtualRoom\Web;
use VirtualRoom\Controller\Admon\vrAdmonController;
require_once __DIR__.'/../vendor/autoload.php';
session_start();

if(isset($_SESSION["user"]))
{
    $controller= new vrAdmonController();
    $controller->setUser($_SESSION["user"]);

    if(isset($_POST["sender"])){
        $postAndFiles=$_POST;
        if (isset($_FILES["courseThumb"])) {
            $postAndFiles=array_merge($_POST,$_FILES);
        }
        
        $controller->createActionHandler($postAndFiles);
    }
    elseif ($_POST) {
        $controller->deleteActionHandler($_POST);
    }
    
    $controller->renderHeaderNavAndAside();
    $compName= isset($_GET["componentName"])?$_GET["componentName"]:null;
    $controller->componentHandler($compName);
    $controller->renderFooter();             
} 
 else{
    header("Location:adm1nL0g1n.html");
    die(0);
 }