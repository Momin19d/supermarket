<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AdminController.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$adminCtrl = new AdminController;
$eloquent = new Eloquent;

#### UPDATE ADMIN DATA
if(isset($_POST['try_update']))
{
	$adminUpdate = $adminCtrl->editAdminData($_POST['admin_id'], $_POST['admin_name'], $_POST['admin_email'], $_POST['admin_type'], $_POST['admin_status']);
}

#### GET EXISTING ADMIN DATA
if( isset($_POST['try_edit']) )
{
	$_SESSION['SMC_edit_admin_id'] = $_POST['id'];
	$adminData = $adminCtrl->getAdminData($_SESSION['SMC_edit_admin_id']);
}
else
	$adminData = $adminCtrl->getAdminData($_SESSION['SMC_edit_admin_id']);

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Edit Admin</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					Edit Admin Registration Form
				</header>
				<div class="panel-body">
					
					<?php 
					# UPDATE MESSAGE
					if(isset($_POST['try_update']))
					{
						if(@$adminUpdate > 0)
							echo '<div class="alert alert-success">The Admin record is updated successfully!</div>';
						else
							echo '<div class="alert alert-danger">Something went wrong! Unable to update. Please recheck.</div>';
					}
					?>
				
					<div class="form">
						<form class="cmxform form-horizontal adminex-form" id="signupForm" method="post" action="">
							<div class="form-group ">
								<label for="AdminName" class="control-label col-lg-2">Admin Name</label>
								<div class="col-lg-7">
									<input class=" form-control" name="admin_name" type="text" value="<?php echo $adminData[0]['admin_name']; ?>" />
								</div>
							</div>
							<div class="form-group ">
								<label for="email" class="control-label col-lg-2">Admin Email</label>
								<div class="col-lg-7">
									<input class="form-control " name="admin_email" type="email" value="<?php echo $adminData[0]['admin_email']; ?>" />
								</div>
							</div>
							<div class="form-group ">
								<label for="AdminType" class="control-label col-lg-2">Admin Status</label>
								<div class="col-lg-7">
										<select class="form-control" name="admin_type">
											<option <?php if($adminData[0]['admin_type'] == "Root Admin") echo "selected"; ?>>Root Admin</option>
											<option <?php if($adminData[0]['admin_type'] == "Content Manager") echo "selected"; ?>>Content Manager</option>
											<option <?php if($adminData[0]['admin_type'] == "Sales Manager") echo "selected"; ?>>Sales Manager</option>
											<option <?php if($adminData[0]['admin_type'] == "Technical Operator") echo "selected"; ?>>Technical Operator</option>
										</select>
								</div>
							</div>							
							<div class="form-group ">
								<label for="AdminStatus" class="control-label col-lg-2">Admin Status</label>
								<div class="col-lg-7">
										<select class="form-control m-bot15" name="admin_status">
											<option <?php if($adminData[0]['admin_status'] == "Active") echo "selected"; ?>>Active</option>
											<option <?php if($adminData[0]['admin_status'] == "Inactive") echo "selected"; ?>>Inactive</option>
										</select>
								</div>
							</div>
							<input type="hidden" name="admin_id" value="<?php echo $adminData[0]['id']; ?>" />
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="try_update" class="btn btn-primary" type="submit">Update</button>
									<a href="list-admin.php" class="btn btn-default" style="text-decoration: none;">Admin List</a>
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