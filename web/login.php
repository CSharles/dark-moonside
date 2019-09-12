<?php
namespace VirtualRoom\Web;

use VirtualRoom\Controller\Admon\vrLoginController;

require_once __DIR__.'/../vendor/autoload.php';

session_start();

try {
	$controller = new vrLoginController();
	$response = $controller->actionHandler();
	echo $response;
} catch (Exception $e) {
	echo $e->getMessage();
}