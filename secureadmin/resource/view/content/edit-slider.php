<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$control = new Controller;
$eloquent = new Eloquent;

#### UPDATE SLIDER DATA
if(isset($_POST['try_update']))
{
	if(empty($_FILES['slider_file']['name']))
	{
		# NO IMAGE
		$tableName = "slides";
		$columnValue["slider_title"] = $_POST['slider_title'];
		$columnValue["slider_status"] = $_POST['slider_status'];
		$columnValue["slider_sequence"] = $_POST['slider_sequence'];
		$whereValue["id"] = $_SESSION['SMC_edit_slider_id'];
		$updateResult = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
	else
	{
		# HAS IMAGE 
		if( $control->checkImage(@$_FILES['slider_file']['type'], @$_FILES['slider_file']['size'], @$_FILES['slider_file']['error']) == 1)
		{
			$filename = "SLIDER_" . date("YmdHis") . "_" . $_FILES['slider_file']['name'];
			
			$tableName = "slides";
			$columnValue["slider_title"] = $_POST['slider_title'];
			$columnValue["slider_file"] = $filename;
			$columnValue["slider_status"] = $_POST['slider_status'];
			$columnValue["slider_sequence"] = $_POST['slider_sequence'];
			$whereValue["id"] = $_SESSION['SMC_edit_slider_id'];
			$updateResult = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if($updateResult > 0)
			{
				move_uploaded_file($_FILES['slider_file']['tmp_name'], $GLOBALS['SLIDES_DIRECTORY'] . $filename);
				
				unlink($_SESSION['SMC_edit_slider_slider_file_old']);
			}
		}
	}
}

#### GET EXISTING SLIDER DATA
if( isset($_POST['try_edit']) )
{
	$_SESSION['SMC_edit_slider_id'] = $_POST['id'];
	
	$columnName = "*";
	$tableName = "slides";
	$whereValue["id"] = $_SESSION['SMC_edit_slider_id'];
	$queryResult = $eloquent->selectData($columnName, $tableName, @$whereValue);
}
else
{
	$columnName = "*";
	$tableName = "slides";
	$whereValue["id"] = $_SESSION['SMC_edit_slider_id'];
	$queryResult = $eloquent->selectData($columnName, $tableName, @$whereValue);
}

$_SESSION['SMC_edit_slider_slider_file_old'] = $GLOBALS['SLIDES_DIRECTORY'] . $queryResult[0]['slider_file']; 

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Edit Slider</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					Edit Slider Registration Form
				</header>
				<div class="panel-body">
					
					<?php 
					
					if(isset($_POST['try_update']))
					{
						if($queryResult > 0)
							echo '<div class="alert alert-success">The Slider record is updated successfully!</div>';
						else
							echo '<div class="alert alert-danger">Something went wrong! Unable to update. Please recheck.</div>';
					}
					?>
				
					<div class="form">
						<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label for="SliderTitle" class="col-lg-2 col-sm-2 control-label">Slider Title</label>
								<div class="col-lg-7">
									<input name="slider_title" value="<?php echo $queryResult[0]['slider_title'] ?>" type="text" class="form-control" required >
								</div>
							</div>
							<div class="form-group">
								<label for="SliderImage" class="control-label col-md-2 ">Slider Image</label>
								<div class="controls col-md-9">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input name="slider_file" type="file" class="default" onchange="readURL(this);" />
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
							</div>
							<div class="form-group last">
								<label for="SliderPreview" class="control-label col-md-2">Slider Preview</label>
								<div class="col-md-9">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 400px; height: 200px;">
											<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['SLIDES_DIRECTORY'] . $queryResult[0]['slider_file']; ?>" alt="" id="blah" />
										</div>
									</div>
									<br/>
								</div>
							</div>
							<div class="form-group">
								<label for="SliderSequence" class="col-lg-2 col-sm-2 control-label">Slider Sequence</label>
								<div class="col-lg-7">
									<input name="slider_sequence" value="<?php echo $queryResult[0]['slider_sequence'] ?>" type="number" class="form-control" required>
								</div>
							</div>
							<div class="form-group ">
								<label for="SliderStatus" class="control-label col-lg-2">Slider Status</label>
								<div class="col-lg-7">
									<select class="form-control m-bot15" name="slider_status">
										<option <?php if($queryResult[0]['slider_status'] == "Active") echo "selected"; ?>>Active</option>
										<option <?php if($queryResult[0]['slider_status'] == "Inactive") echo "selected"; ?>>Inactive</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="try_update" class="btn btn-primary" type="submit">Update</button>
									<a href="list-slider.php" class="btn btn-default" style="text-decoration: none;">Slider List</a>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->