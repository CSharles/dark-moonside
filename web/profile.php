<?php
session_start();
if(isset($_SESSION["user"])){
    require_once __DIR__."/../src/Controller/vrProfileController.php";
    require_once __DIR__."/../src/View/adm1nHeader.php";
    require_once __DIR__."/../src/View/adm1nNav.php";
    if($controller->getGeneralView()){
        require_once __DIR__."/../src/View/adm1nAside.php";
        require_once __DIR__."/../src/View/adm1nProfileBody.php";
    }
    else{
        require_once __DIR__."/../src/View/editAdm1nProfileBody.php";
    }
    require_once __DIR__."/../src/View/adm1nFooter.php";
}
else{
    header("Location:adm1nL0g1n.html");
}
