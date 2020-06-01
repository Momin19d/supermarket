<?php
##### CODE FOR LOGOUT #####
# In GET method if someone sends "yes" as value against "exit" then Destroy Session
if(@$_REQUEST['exit'] == "yes")
{
	session_start() ;
	session_destroy() ;
	header("Location: index.php");
}


##### ACCESS TO USERS ONLY #####
# Force user to go to Login Page, if there is no Session
if( empty($_SESSION['SMC_login_time']) && empty($_SESSION['SMC_login_id']) )
{
	header("Location: index.php"); 
}


##### ACCESS LEVEL WISE ACCESS CONTROL #####
# Configuration
$pagename = basename($_SERVER['PHP_SELF']);

# Access Control for Technical Operator
$technicalOperatorPages = ['create-product.php', 'list-product.php', 'create-slider.php', 'list-slider.php', 'list-customer.php'];

if( in_array($pagename, $technicalOperatorPages) && $_SESSION['SMC_login_admin_type'] == "Technical Operator" )
{
	header("Location: dashboard.php");
}

##### Access Control for Content Manager #####
$contentManagerPages = ['create-admin.php', 'list-admin.php', 'create-category.php', 'list-category.php', 'create-subcategory.php', 'list-subcategory.php', 'list-customer.php', 'list-order.php', 'detail-order.php'];

if( in_array($pagename, $contentManagerPages) && $_SESSION['SMC_login_admin_type'] == "Content Manager" )
{
	header("Location: dashboard.php");
}

##### Access Control for Sales Manager #####
$salesManagerPages = ['create-product.php', 'list-product.php', 'create-slider.php', 'list-slider.php', 'create-admin.php', 'list-admin.php', 'create-category.php', 'list-category.php', 'create-subcategory.php', 'list-subcategory.php'];

if( in_array($pagename, $salesManagerPages) && $_SESSION['SMC_login_admin_type'] == "Sales Manager" )
{
	header("Location: dashboard.php");
}
?>