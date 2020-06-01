<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

#### DELETE SLIDER
if(isset($_REQUEST['did']))
{
	# GET FILE INFORMATION THAT YOU ARE GOING TO DELETE
	$columnName = "*";
	$tableName = "slides";
	$whereValue["id"] = $_REQUEST['did'];
	$deletingFile = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	# DELETE THE FILE
	$tableName = "slides";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteResult = $eloquent->deleteData($tableName, $whereValue);
	
	if($deleteResult > 0)
	{
		unlink($GLOBALS['SLIDES_DIRECTORY'] . $deletingFile[0]['slider_file']);
	}
}

#### CHANGE STATUS
if(isset($_POST['change_status']))
{
	$tableName = "slides";
	$whereValue["id"] = $_POST['slider_status_id'];
	
	if($_POST['current_status'] == "Active")
	{
		$columnValue["slider_status"] = "Inactive";
	}
	else if($_POST['current_status'] == "Inactive")
	{
		$columnValue["slider_status"] = "Active";
	}
	
	$updateStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

# GET CATEGORY LIST
$columnName = "*";
$tableName = "slides";
$queryResult = $eloquent->selectData($columnName, $tableName);

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
        <div class="col-sm-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">List Category</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					CATEGORY LIST
				</header>
				<div class="panel-body">
				
					<?php 
						# DELETE MESSAGE
						if(isset($_REQUEST['did']))
						{
							if($deleteResult > 0)
								echo '<div class="alert alert-success">The Slider is deleted successfully</div>';
							else
								echo '<div class="alert alert-danger">Something went wrong! Unable to delete. Please recheck.</div>';
						}		
						
						# STATUS CHANGE MESSAGE
						if(isset($_POST['change_status']))
						{
							if($updateStatus > 0)
								echo '<div class="alert alert-success">The Slider is updated successfully</div>';
							else
								echo '<div class="alert alert-danger">Something went wrong! Unable to change status. Please recheck.</div>';
						}
					?>
				
					<div class="adv-table">
						<table  class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th>Slider ID</th>
									<th>Slider Title</th>
									<th>Slider Status</th>
									<th>Slider Image</th>
									<th>Slider Sequence</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php 
								$n=1;
								foreach($queryResult AS $eachRow)
								{
									echo '
									<tr class="">
										<td>'.$n.'</td>
										<td>'.$eachRow['slider_title'].'</td>
										<td class="center">
											<form method="post" action="">
												<input type="hidden" name="slider_status_id" value="'.$eachRow['id'].'" />
												<input type="hidden" name="current_status" value="'.$eachRow['slider_status'].'" />
												<button name="change_status" class="btn btn-info btn-xs" type="submit">'.$eachRow['slider_status'].'</button>
											</form>
										</td>
										<td class="center">
											<a target="_blank" href="'.$GLOBALS['SLIDES_DIRECTORY'] . $eachRow['slider_file'].'"> 
												<img src="'. $GLOBALS['SLIDES_DIRECTORY'] . $eachRow['slider_file'] .'" height="60px" width="160px" />
											</a>
										</td>
										<td>'.$eachRow['slider_sequence'].'</td>
										<td class="center">
											<div class="row">
												<a data-id="'.$eachRow['id'].'" class="btn btn-danger btn-xs deleteButton" href="#deleteModal" data-toggle="modal"><i class="fa fa-trash-o"></i> Delete</a>
												<form method="post" action="edit-slider.php" style="display: inline;">
													<input type="hidden" name="id" value="'.$eachRow['id'].'"/>
													<button name="try_edit" class="btn btn-warning btn-xs" type="submit"><i class="fa fa-pencil-square"></i> Edit</button>
												</form>
											</div>
										</td>
									</tr>
									';
									$n++;
								}
							?>
								 
							</tbody>
							<tfoot>
								<tr>
									<th>Slider ID</th>
									<th>Slider Title</th>
									<th>Slider Status</th>
									<th>Slider Image</th>
									<th>Slider Sequence</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
	<!--body wrapper end-->
	
<!-- DELETE MODAL -->
<div class="modal small fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Slider?</h4>
			</div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this Slider?</h5>
            </div>
            <div class="modal-footer">
				<button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Cancel</button> 
				<a href="#" class="btn btn-danger" id="modalDelete" >Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- LIBRARY -->
<script src="public/js/jquery-1.10.2.min.js"></script>

<!-- SCRIPT TO DELETE -->
<script>
$('.deleteButton').click(function(){
	var id = $(this).data('id');
	
	$('#modalDelete').attr('href','list-slider.php?did='+id);
})
</script>