<?php
namespace VirtualRoom\Web;

use VirtualRoom\Controller\Admon\vrLoginController;

require_once __DIR__.'/../vendor/autoload.php';

session_start();
$response= false;
try {
	$controller = new vrLoginController();
	$response = $controller->actionHandler($_POST);
} catch (Exception $e) {
	$response= $e->getMessage();
}
finally{
	echo $response;
}