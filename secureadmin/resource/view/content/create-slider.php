<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$control = new Controller;
$eloquent = new Eloquent;

#### INSERT SLIDER DATA incl. FILE VALIDATION
if( isset($_POST['create_slider']) )
{
	if( $control->checkImage(@$_FILES['slider_file']['type'], @$_FILES['slider_file']['size'], @$_FILES['slider_file']['error']) == 1)
	{
		$filename = "SLIDER_" . date("YmdHis") . "_" . $_FILES['slider_file']['name'];
		
		# INSERT DATA
		$tableName = "slides";
		$columnValue["slider_title"] = $_POST['slider_title'];
		$columnValue["slider_file"] = $filename;
		$columnValue["slider_status"] = $_POST['slider_status'];
		$columnValue["slider_sequence"] = $_POST['slider_sequence'];
		$queryResult = $eloquent->insertData($tableName, $columnValue);
		
		if($queryResult > 0)
		{
			move_uploaded_file($_FILES['slider_file']['tmp_name'], $GLOBALS['SLIDES_DIRECTORY'] . $filename);
		}
	}
}

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Add Slider</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					Add Slider Image
				</header>
				<div class="panel-body">
					
					<?php
					#INSERT MESSAGE
					if( isset($_POST['create_slider']) )
					{
						if($queryResult > 0)
							echo '<div class="alert alert-success">The slider image is uploaded successfully.</div>';
						else
							echo '<div class="alert alert-danger">Something went wrong! Please recheck!</div>';
					}
					?>
				
					<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label for="SliderTitle" class="col-lg-2 col-sm-2 control-label">Slider Title</label>
							<div class="col-lg-7">
								<input name="slider_title" type="text" class="form-control" placeholder="Slider Title" required >
							</div>
						</div>
						<div class="form-group">
							<label for="SliderImage" class="control-label col-md-2 ">Slider Image</label>
							<div class="controls col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<span class="btn btn-default btn-file">
										<input name="slider_file" type="file" class="default" onchange="readURL(this);" required />
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
										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="blah" style="width: 100%; height: 100%;"/>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="SliderSequence" class="col-lg-2 col-sm-2 control-label">Slider Sequence</label>
							<div class="col-lg-7">
								<input name="slider_sequence" type="number" class="form-control" placeholder="Slider Sequence" required>
							</div>
						</div>
						<div class="form-group ">
							<label for="SliderStatus" class="control-label col-lg-2">Slider Status</label>
							<div class="col-lg-7">
									<select name="slider_status" class="form-control m-bot15" required>
										<option>Active</option>
										<option>Inactive</option>
									</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button name="create_slider" class="btn btn-success" type="submit">Save</button>
							<button class="btn btn-default" type="reset">Reset</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->