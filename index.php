<?php
include("common.php");

function index()
{


	$action = $_GET['action'] == '' ? 'index' : $_GET['action'];
	$class = $_GET['class'] == '' ? $action : $_GET['class'];
	$func = $_GET['func'] == '' ? 'index' : $_GET['func'];
	
	
	include($action . '.php');
	$instance = new $action();
	
    call_user_func(array($instance, $func)); 
	
	
}

index();
?>


