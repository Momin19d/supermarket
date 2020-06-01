<?php
include("app/Http/Controllers/View.php");

$view = new View;
 
	$view->loadContent("include", "top");
	$view->loadContent("content", "checkout");
	$view->loadContent("include", "tail");
?>
