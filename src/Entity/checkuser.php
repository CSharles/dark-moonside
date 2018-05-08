<?php 
session_start();
require __DIR__ ."/../Repository/vrAdmonRepository.php";

$data = $_POST['data'];
$decoded = json_decode($data, true);
$decoded  = filter_var_array($decoded, FILTER_SANITIZE_STRING);
$user=$decoded['user'];
$password=$decoded['password'];

$repo = new vrAdmonRepository($user,$password);
if(!$repo->hasError()){
    $_SESSION["user"]=$user;
    $_SESSION["password"]=$password;
    echo true;
}
else{
    echo $repo->getError()["code"];
}
?>
