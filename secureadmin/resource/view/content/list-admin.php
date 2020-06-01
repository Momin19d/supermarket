<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AdminController.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$adminCtrl = new AdminController;
$eloquent = new Eloquent;

#### DELETE ADMIN DATA
if( isset($_POST['try_delete']) )
{
	$rowDeleted = $adminCtrl->deleteAdminData($_POST['id']);
}

#### CHANGE ADMIN STATUS
if( isset($_POST['try_status_change']) )
{
	$statusChange = $adminCtrl->changeAdminStatus($_POST['id'], $_POST['current_status']);
}

#### GET ADMIN DATA
$adminList = $adminCtrl->listAdminData();

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
        <div class="col-sm-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">List Admin</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					List of Admin
				</header>
				<div class="panel-body">
				
				<?php
				# DELETE MESSAGE
				if( isset($_POST['try_delete']) )
				{
					if($rowDeleted > 0)
						echo '<div class="alert alert-success">The Admin is deleted successfully!</div>';
					else
						echo '<div class="alert alert-danger">Something went wrong! Please recheck.</div>';
				}

				# STATUS CHANGE MESSAGE
				if( isset($_POST['try_status_change']) )
				{
					if($statusChange > 0)
						echo '<div class="alert alert-success">The Admin Status is changed successfully!</div>';
					else
						echo '<div class="alert alert-danger">Something went wrong! Please recheck.</div>';
				}
				?>
				
					<div class="adv-table">
						<table  class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th>Admin ID</th>
									<th>Admin Name</th>
									<th>Admin Email</th>
									<th>Admin Type</th>
									<th>Admin Status</th>
									<th class="hidden-phone">Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php 
							$n = 1;
							foreach($adminList AS $eachRow)
							{
								echo '
									<tr class="gradeA">
										<td>'.$n.'</td>
										<td>'.$eachRow['admin_name'].'</td>
										<td>'.$eachRow['admin_email'].'</td>
										<td>'.$eachRow['admin_type'].'</td>
										<td class="center">
											<div>
												<form action="" method="post">
													<input type="hidden" name="id" value="'.$eachRow['id'].'" />
													<input type="hidden" name="current_status" value="'.$eachRow['admin_status'].'" />
													<button name="try_status_change" class="btn btn-info btn-xs" type="submit">'.$eachRow['admin_status'].'</button>
												</form>
											</div>
										</td>
										<td class="center">
											<div class="row">
												<form action="" method="post" style="display: inline">
													<input type="hidden" name="id" value="'.$eachRow['id'].'" />
													<button name="try_delete" type="submit" class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> Delete</button>
												</form>
												<form action="edit-admin.php" method="post" style="display: inline">
													<input type="hidden" name="id" value="'.$eachRow['id'].'" />
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
									<th>Admin ID</th>
									<th>Admin Name</th>
									<th>Admin Email</th>
									<th>Admin Type</th>
									<th>Admin Status</th>
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