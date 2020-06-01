<?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

# CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

##### LOAD THE "Subcategory List" OF A "Category ID" ON EDIT PRODUCT PAGE
if($_POST['ajax_edit_product'] == "YES")
{
	$columnName = "*";
	$tableName = "subcategories";
	$whereValue['category_id'] = $_POST['category_id'];
	$subcategoryList = $eloquent->selectData($columnName, $tableName, $whereValue);

	echo '<option value="">Select a Subcategory</option>';

	foreach($subcategoryList AS $eachRow)
	{
		echo '<option value="'. $eachRow['id'] .'" ';
		
		if($eachRow['id'] == $_POST['subcategory_id'])
			echo 'selected';
		
		echo ' >'. $eachRow['subcategory_name'] .'</option>';
	}
}

##### LOAD THE "Subcategory List" OF A "Category ID" ON CREATE PRODUCT PAGE
if($_POST['ajax_create_product'] == "YES")
{
	$columnName = "*";
	$tableName = "subcategories";
	$whereValue['category_id'] = $_POST['category_id'];
	$subcategoryList = $eloquent->selectData($columnName, $tableName, $whereValue);

	echo '<option value="">Select a Subcategory</option>';

	foreach($subcategoryList AS $eachRow)
	{
		echo '<option value="'. $eachRow['id'] .'" >'. $eachRow['subcategory_name'] .'</option>';
	}
}

?>