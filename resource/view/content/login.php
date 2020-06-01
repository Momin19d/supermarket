 <?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");

$eloquent = new Eloquent;

# LOGIN #
if(isset($_POST['try_login']))
{
	$columnName = "*";
	$tableName = "customers";
	$whereValue['customer_email'] = $_POST['username'];
	$whereValue['customer_password'] = sha1($_POST['password']);
	$customerData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	if(!empty($customerData))
	{
		$_SESSION['SMCF_login_time'] = date("Y-m-d H:i:s");
		$_SESSION['SMCF_login_customer_id'] = $customerData[0]['id'];
		$_SESSION['SMCF_login_customer_name'] = $customerData[0]['customer_name'];
		$_SESSION['SMCF_login_customer_email'] = $customerData[0]['customer_email'];
		$_SESSION['SMCF_login_customer_mobile'] = $customerData[0]['customer_mobile'];
		$_SESSION['SMCF_login_customer_address'] = $customerData[0]['customer_address'];
		$_SESSION['SMCF_login_customer_status'] = $customerData[0]['customer_status'];
		
		echo '<meta http-equiv="Refresh" content="0; url=index.php" />';
	}
}

?>

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-lg-last dashboard-content">
                        <h2>Login to your Account</h2>
						
						<?php 
						if(isset($_POST['try_login']))
						{
							if( empty($customerData) )
							{
								echo '
									<div class="alert alert-danger">
										Either customer doesn\'t exist or the credential is wrong. Please retry!
									</div>
								';
							}
						}
						?>
                        
                        <form action="" method="post">
                            
                            <div class="form-group required-field">
                                <label for="acc-email">Email Address</label>
                                <input name="username" type="email" class="form-control" id="acc-email" required>
                            </div>

                            <div class="form-group required-field">
                                <label for="acc-password">Password</label>
                                <input name="password" type="password" class="form-control" id="acc-password" required>
                            </div><!-- End .form-group -->

                            <div class="mb-2"></div><!-- margin -->

                            <div class="required text-right">* Required Field</div>
                            <div class="form-footer">
                                <a href="index.php"><i class="icon-angle-double-left"></i>Back</a>

                                <div class="form-footer-right">
                                    <button name="try_login" type="submit" class="btn btn-primary">Log in</button>
                                </div>
								<div class="form-footer-right">
                                    <a href="register.php">Don't have an account?Sign up</a>
                                </div>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- End .col-lg-9 -->

                    <aside class="sidebar col-lg-3">
                        <div class="widget widget-dashboard">
                            <h3 class="widget-title">My Account</h3>

                            <ul class="list">
                                <li class="active"><a href="#">Account Dashboard</a></li>
                                <li><a href="#">Account Information</a></li>
                                <li><a href="#">Address Book</a></li>
                                <li><a href="#">My Orders</a></li>
                                <li><a href="#">Billing Agreements</a></li>
                                <li><a href="#">Recurring Profiles</a></li>
                                <li><a href="#">My Product Reviews</a></li>
                                <li><a href="#">My Tags</a></li>
                                <li><a href="#">My Wishlist</a></li>
                                <li><a href="#">My Applications</a></li>
                                <li><a href="#">Newsletter Subscriptions</a></li>
                                <li><a href="#">My Downloadable Products</a></li>
                            </ul>
                        </div><!-- End .widget -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-5"></div><!-- margin -->
        </main><!-- End .main -->
