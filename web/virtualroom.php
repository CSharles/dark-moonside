<?php
session_start();
//if(isset($_SESSION["user"])){
    require_once __DIR__."/../src/Controller/vrWebController.php";
    require_once __DIR__."/../src/View/webHead.php";
    
    //require_once __DIR__."/../src/View/webNav.php";
    //if($controller->getGeneralView()){
        //require_once __DIR__."/../src/View/webAside.php";
        require_once __DIR__."/../src/View/webNav.html";
        $controller = new vrWebController();
        $id=isset($_GET["id"])?$_GET["id"]:NULL;
        $controller->courseActionHandler($id);
        
    //}
    //else{
      //  require_once __DIR__."/../src/View/editProfileBody.php";
    //}
    require_once __DIR__."/../src/View/webFooter.php";
//}
//else{
//    header("Location:Login.html");
//}