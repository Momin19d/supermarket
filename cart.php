<?php
include("app/Http/Controllers/View.php");

$view = new View;
 
	$view->loadContent("include", "top");
	$view->loadContent("content", "cart");
	$view->loadContent("include", "tail");
?>
 