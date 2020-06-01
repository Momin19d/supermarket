 <?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");

# CALLING MODEL / QUERY BUILDER
$eloquent = new Eloquent;

# SAVE CUSTOMER #
if(isset($_POST['try_registration']))
{
	$tableName = "customers";
	$columnValue["customer_name"] = $_POST['first_name'] . " " . $_POST['last_name'];
	$columnValue["customer_mobile"] = $_POST['contact_no'];
	$columnValue["customer_address"] = $_POST['customer_addr'];
	$columnValue["customer_email"] = $_POST['email_address'];
	$columnValue["customer_password"] = sha1($_POST['customer_pass']);
	$columnValue["created_at"] = date("Y-m-d H:i:s");
	$saveCustomer = $eloquent->insertData($tableName, $columnValue);
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
                        <h2>Register your Account</h2>
						
						<?php 
						if(isset($_POST['try_registration']))
						{
							if($saveCustomer['NO_OF_ROW_INSERTED'])
							{
								echo '
									<div class="alert alert-success">
										Dear concern, thanks for registering on our website. Now login and enjoy!
									</div>
								';
							}
						}
						?>
                        
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-11">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="acc-name">First Name</label>
                                                <input name="first_name" type="text" class="form-control" id="acc-name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="acc-lastname">Last Name</label>
                                                <input name="last_name" type="text" class="form-control" id="acc-lastname" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="form-group required-field">
                                <label for="acc-email">Contact No</label>
                                <input name="contact_no" type="number" class="form-control" id="acc-email" placeholder="8801*********" required>
                            </div>
							
							<div class="form-group required-field">
                                <label for="acc-email">Full Address</label>
                                <input name="customer_addr" type="text" class="form-control" id="acc-email" placeholder="Give your full address" required>
                            </div>

                            <div class="form-group required-field">
                                <label for="acc-email">Email Address</label>
                                <input name="email_address" type="email" class="form-control" id="acc-email" required>
                            </div>

                            <div class="form-group required-field">
                                <label for="acc-password">Password</label>
                                <input name="customer_pass" type="password" class="form-control" id="acc-password" required>
                            </div><!-- End .form-group -->

                            <div class="mb-2"></div><!-- margin -->

                            <div class="required text-right">* Required Field</div>
                            <div class="form-footer">
                                <a href="#"><i class="icon-angle-double-left"></i>Back</a>

                                <div class="form-footer-right">
                                    <button name="try_registration" type="submit" class="btn btn-primary">Save</button>
                                </div>
								<div class="form-footer-right">
                                    <a href="login.php">Now Log in here!</a>
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
