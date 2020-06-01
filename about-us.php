<?php
include("app/Http/Controllers/View.php");

$view = new View;
 
	$view->loadContent("include", "top");
	$view->loadContent("content", "about-us");
	$view->loadContent("include", "tail");
?>
