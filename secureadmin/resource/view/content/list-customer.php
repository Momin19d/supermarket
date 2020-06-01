<?php
#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$eloquent = new Eloquent;

#### DELETE CUSTOMERS
if(isset($_REQUEST['did']))
{
	# Get the Delete File Information
	$columnName = "*";
	$tableName = "customers";
	$whereValue["id"] = $_REQUEST['did'];
	$deletingFile = $eloquent->selectData($columnName, $tableName, @$whereValue);

	# Delete the File
	$tableName = "customers";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteResult = $eloquent->deleteData($tableName, $whereValue);
}	

##### CHANGE STATUS
if(isset($_POST['change_status']))
{
	$tableName = "customers";
	$whereValue["id"] = $_POST['customer_status_id'];
	
	if($_POST['current_status'] == "Active")
	{
		$columnValue["customer_status"] = "Inactive";
	}
	else if($_POST['current_status'] == "Inactive")
	{
		$columnValue["customer_status"] = "Active";
	}
	
	$updateStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

#### CUSTOMER'S LIST
$columnName = "*";
$tableName = "customers";
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
				<li class="active">Customer List</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					List of Customers
				</header>
				<div class="panel-body">
					
				<?php
				# DELETE MESSAGE
				if(isset($_REQUEST['did']))
				{
					if($deleteResult > 0)
						echo '<div class="alert alert-success">The Customer data is deleted successfully!</div>';
					else
						echo '<div class="alert alert-danger">Something went wrong to delete! Please recheck.</div>';
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
						<table class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th>CIN</th>
									<th>Customer Name</th>
									<th>Customer Email</th>
									<th>Customer Mobile</th>
									<th>Customer Address</th>
									<th>Sign Up Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
								<?php 
								$n = 1;
								foreach ($queryResult as $eachRow) 
								{
									echo '
									<tr class="gradeA">
										<td>'.$n.'</td>
										<td>'.$eachRow["customer_name"].'</td>
										<td>'.$eachRow["customer_email"].'</td>
										<td>'.$eachRow["customer_mobile"].'</td>
										<td>'.$eachRow["customer_address"].'</td>
										<td>'.$eachRow["created_at"].'</td>
										<td class="center">
											<form method="post" action="">
												<input type="hidden" name="customer_status_id" value="'.$eachRow['id'].'" />
												<input type="hidden" name="current_status" value="'.$eachRow['customer_status'].'" />
												<button name="change_status" class="btn btn-info btn-xs" type="submit">'.$eachRow["customer_status"].'</button>
											</form>
										</td>
										<td class="center">
											<a data-id="'.$eachRow['id'].'" href="#deleteModal" class="btn btn-danger btn-xs float-right deleteButton" data-toggle="modal">
												<i class="fa fa-trash-o"></i> Delete
											</a>
										</td>
									</tr>
									';
									$n++;
								}
								?>
								
							</tbody>
							<tfoot>
								<tr>
									<th>CIN</th>
									<th>Customer Name</th>
									<th>Customer Email</th>
									<th>Customer Mobile</th>
									<th>Customer Address</th>
									<th>Sign Up Date</th>
									<th>Status</th>
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

<!-- Delete Modal Start -->
<div class="modal small fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Customer?</h4>
			</div>
			<div class="modal-body">
				<h5>Are you sure you want to delete this Customer?</h5>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Cancel</button> 
				<a href="list-customer.php" class="btn btn-danger" id="modalDelete" >Delete</a>
			</div>
		</div>
	</div>
</div>
<!-- Delete Modal End -->

<!-- LIBRARY -->
<script src="public/js/jquery-1.10.2.min.js"></script>

<!-- Script to Delete Start-->
<script>
	$('.deleteButton').click(function(){
		var id = $(this).data('id');
		
		$('#modalDelete').attr('href','list-customer.php?did='+id);
	})
</script>
<!-- Script to Delete End-->