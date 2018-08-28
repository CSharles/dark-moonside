<?php
session_start();
//require __DIR__."/../src/Controller/vrProfileController.php";
if(isset($_SESSION["user"])){
    //$adminNav= require_once __DIR__."/../src/View/adm1nNav.php";
   // $adminAside = require_once __DIR__."/../src/View/adm1nAside.php";
    require_once __DIR__."/../src/View/adm1nHeader.php";
    require_once __DIR__."/../src/View/adm1nProfileBody.php";
    require_once __DIR__."/../src/View/adm1nFooter.php";
}
else{
    header("Location:adm1nL0g1n.html");
}
?>