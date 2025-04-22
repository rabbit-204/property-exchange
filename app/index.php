<?php
session_start();
require "./Controllers/BaseController.php";
$controller = ($_REQUEST['controller'] ?? 'homepage');
$controllerName = ucfirst((strtolower($controller)) . 'Controller');
require "./Controllers/$controllerName.php";
$actionName = ($_REQUEST['action'] ?? 'index');
// echo __FILE__;
$controller = new $controllerName();
$controller->$actionName();
?>