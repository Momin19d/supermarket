<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AdminController.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$adminCtrl = new AdminController;
$eloquent = new Eloquent;

#### INSERT ADMIN DATA
if( isset($_POST['create_admin']) )
{
	$saveResult = $adminCtrl->createAdminData($_POST['admin_name'], $_POST['admin_email'], sha1($_POST['admin_password']), $_POST['admin_type'], $_POST['admin_status']);
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
            <li class="active">Create Admin</li>
        </ul>
        <!--breadcrumbs end -->
		
            <section class="panel">
                <header class="panel-heading">
                    New Admin Registration Form
                </header>
                <div class="panel-body">
				
				<?php 
					#INSERT MESSAGE
					if( isset($_POST['create_admin']) )
					{	
						if($saveResult > 0)
							echo '<div class="alert alert-success"> The Admin is created successfully! </div>';
						else
							echo '<div class="alert alert-danger"> Something went wrong while adding the Admin! Please recheck. </div>';
					}		
				?>
				
                    <div class="form">
                        <form class="cmxform form-horizontal adminex-form" id="AdminRegistration" method="post" action="">
                            <div class="form-group ">
                                <label for="AdminName" class="control-label col-lg-2">Admin Name</label>
                                <div class="col-lg-7">
                                    <input class=" form-control" name="admin_name" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="AdminEmail" class="control-label col-lg-2">Admin Email</label>
                                <div class="col-lg-7">
                                    <input class="form-control "name="admin_email" type="email" autocomplete="none" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="AdminPassword" class="control-label col-lg-2">Admin Password</label>
                                <div class="col-lg-7">
                                    <input class="form-control" name="admin_password" type="password" autocomplete="none" required />
                                </div>
                            </div>
							<div class="form-group ">
                                <label for="AdminType" class="control-label col-lg-2">Admin Type</label>
                                <div class="col-lg-7">
                                    <select name="admin_type" class="form-control">
										<option value="">Select a Type</option>
										<option value="Root Admin">Root Admin</option>
										<option value="Content Manager">Content Manager</option>
										<option value="Sales Manager">Sales Manager</option>
										<option value="Technical Operator">Technical Operator</option>
									</select>
                                </div>
                            </div>							
							<div class="form-group ">
                                <label for="AdminStatus" class="control-label col-lg-2">Admin Status</label>
                                <div class="col-lg-7">
                                    <select name="admin_status" class="form-control m-bot15">
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
									</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button name="create_admin" class="btn btn-success" type="submit">Save</button>
                                    <button class="btn btn-default" type="reset">Reset</button>
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