 <?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");
include("app/Http/Controllers/SSLCommerz.php");

$eloquent = new Eloquent;

##### SUBMIT ORDER | SAVE ORDER DETEAILS IN `orders` TABLE AND `order_items` TABLE (REMOVING FROM `shopcarts` TABLE)
if(isset($_POST['submit_order']))
{
	# SUBMIT ORDER | SAVING ORDER in `orders` TABLE
	$columnValue = $tableName = null;
	$tableName = "orders";
	$columnValue["order_date"] = date("Y-m-d H:i:s");
	$columnValue["customer_id"] = @$_SESSION['SMCF_login_customer_id'];
	$columnValue["sub_total"] = $_POST['sub_total'];
	$columnValue["delivery_charge"] = $_POST['delivery_charge'];
	$columnValue["grand_total"] = $_POST['grand_total'];
	$columnValue["created_at"] = date("Y-m-d H:i:s");
	$saveOrderDetails = $eloquent->insertData($tableName, $columnValue);
	
	if($saveOrderDetails['NO_OF_ROW_INSERTED'] > 0)
	{
		# GET `order_id` FROM THE LAST INSERT ID
		$_SESSION['SMCF_order_order_id'] = $saveOrderDetails['LAST_INSERT_ID'];
		
		# GET ALL DATA FROM `shopcarts` FOR THE LOGGED IN CUSTOMER
		$columnName = $tableName = $joinType = $onCondition = $whereValue = $formatBy = $paginate = null;
		$columnName["1"] = "products.id";
		$columnName["2"] = "products.product_price";
		$columnName["3"] = "shopcarts.quantity";
		$tableName["MAIN"] = "shopcarts";
		$joinType = "INNER";
		$tableName["1"] = "products";
		$onCondition["1"] = ["shopcarts.product_id", "products.id"];
		$whereValue["shopcarts.customer_id"] = @$_SESSION['SMCF_login_customer_id'];
		$formatBy["DESC"] = "shopcarts.id";
		$shopCartItems = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);

		# ORDER SAVED TO `orders` TABLE SUCCESSFULLY
		# NOW SAVE ORDER ITEMS FROM `shopcarts` TABLE TO `order_items` TABLE
		foreach($shopCartItems AS $eachShopcartItem)
		{
			$columnValue = $tableName = null;
			$tableName = "order_items";
			$columnValue["customer_id"] = $_SESSION['SMCF_login_customer_id'];
			$columnValue["order_id"] = $_SESSION['SMCF_order_order_id'];
			$columnValue["product_id"] = $eachShopcartItem['id'];
			$columnValue["product_price"] = $eachShopcartItem['product_price'];
			$columnValue["quantity"] = $eachShopcartItem['quantity'];
			$columnValue["created_at"] = date("Y:m:d H:i:s");
			$saveOrderItems = $eloquent->insertData($tableName, $columnValue);
		}
		
		# NOW DELETE ALL DATA FROM `shopcarts` AS THEY ARE STORED IN `order_items` TABLE
		if(@$saveOrderItems['NO_OF_ROW_INSERTED'] > 0)
		{
			$tableName = $whereValue = null;
			$tableName = "shopcarts";
			$whereValue["customer_id"] = $_SESSION['SMCF_login_customer_id'];
			$cleanShopcart = $eloquent->deleteData($tableName, $whereValue);
		}
	}
	
}
?>

<?php
##### GO FOR PAYMENT
if(isset($_POST['proceed_to_payment']))
{
	##### GET ORDER DETAILS FROM DATABASE
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "orders";
	$whereValue['id'] = $_SESSION['SMCF_order_order_id'];
	$orderDetailsToPay = $eloquent->selectData($columnName, $tableName, $whereValue);
	
	##### INTEGRATE PAYMENT GATEWAY #####
	if ($_SERVER['SERVER_NAME'] == "localhost") {
		$server_name = 'http://localhost/www.supermarket.com/';
	} else {
		$server_name = 'http://www.supermarket.com/';
	}

	##### ALL CUSTOMER DATA THAT YOU REQUIRE TO SEND TO PAYMENT GATEWAY
	# PAYMENT INFORMATION | REQUIRED
	$post_data = array();
	$post_data['total_amount'] = $orderDetailsToPay[0]['grand_total'];
	$post_data['currency'] = "BDT";
	$post_data['tran_id'] = $orderDetailsToPay[0]['id'];
	$post_data['success_url'] = $server_name . "status.php"; # The page that will show you Payment Success
	$post_data['fail_url'] = $server_name . "status.php"; # The page that will show you Payment Failure
	$post_data['cancel_url'] = $server_name . "status.php"; # The page that will show you Payment Cancelled by Customer

	# CUSTOMER INFORMATION
	$post_data['cus_name'] = $_SESSION['SMCF_login_customer_name'];
	$post_data['cus_email'] = $_SESSION['SMCF_login_customer_email'];
	$post_data['cus_add1'] = $_SESSION['SMCF_login_customer_address'];
	$post_data['cus_add2'] = "";
	$post_data['cus_city'] = "";
	$post_data['cus_state'] = "";
	$post_data['cus_postcode'] = "";
	$post_data['cus_country'] = "Bangladesh";
	$post_data['cus_phone'] = $_SESSION['SMCF_login_customer_mobile'];
	$post_data['cus_fax'] = "";

	# SHIPMENT INFORMATION
	$post_data['ship_name'] = $_SESSION['SMCF_login_customer_name'];
	$post_data['ship_add1 '] = $_SESSION['SMCF_login_customer_address'];
	$post_data['ship_add2'] = "";
	$post_data['ship_city'] = "";
	$post_data['ship_state'] = "";
	$post_data['ship_postcode'] = "";
	$post_data['ship_country'] = "Bangladesh";

	# OPTIONAL PARAMETERS
	$post_data['value_a'] = "ref001";
	$post_data['value_b'] = "ref002";
	$post_data['value_c'] = "ref003";
	$post_data['value_d'] = "ref004";

	$_SESSION['payment_values'] = array();
	$_SESSION['payment_values']['tran_id'] = $post_data['tran_id'];
	$_SESSION['payment_values']['amount'] = $post_data['total_amount'];
	$_SESSION['payment_values']['currency'] = $post_data['currency'];
	##### INTEGRATE PAYMENT GATEWAY #####
}

?>

       <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-1">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </div><!-- End .container -->
            </nav>


            <div class="container">
                <div class="row">
				
                    <div class="col-lg-8">
					
						<!-- CART ADD MESSAGE -->
						<?php 
						if(isset($_POST['submit_order']))
						{
							if(@$cleanShopcart > 0)
								echo '
								<div class="alert alert-success cart-add-message">
								Thank you for Ordering Online. Your order is well received.<br><br>
								Now please proceed to pay online for getting Faster Delivery at Home!
								</div>
							';
						}
						?>
						<!-- CART ADD MESSAGE -->
					
<div class="cart-table-container">

	<div class="alert alert-info">
			<?php 
			# SHOW THIS IMAGE WHEN YOU ARE SUBMITTING "Proceed to Payment" FROM "Cart" PAGE
			if(isset($_POST['submit_order']))
			{
				if(@$cleanShopcart > 0)
					echo '
					<div class="">
					ORDER SUBMIT SUCCESSFUL IMAGE
					</div>';
				else
					echo '
					<div class="">
					ORDER SUBMIT FAILED IMAGE
					</div>';
			}
			?>

<?php 
if(isset($_POST['proceed_to_payment']))
{
    $sslc = new SSLCommerz();
    # initiate(Transaction Data , Whether redirect or Display in Page)
    $payment_options = $sslc->initiate($post_data, true);
	
	echo '<h3>Card Payment</h3>';
	echo '<table width="100%">';
	echo '<tr>';
	foreach ($payment_options['cards'] as $row) 
	{
        echo '<td width="33%">' . $row['name'] .'</td>';
    }
	echo '</tr>';
	echo '<tr>';
	foreach ($payment_options['cards'] as $row) 
	{
        echo '<td width="33%">' . $row['link'] .'</td>';
    }
	echo '</tr>';
	echo '</table>';
	
	echo "<hr>";
	echo '<h3>Mobile Wallet Payment</h3>';
	echo '<table width="100%">';
	echo '<tr>';
	foreach ($payment_options['mobile'] as $row) 
	{
        echo '<td width="25%">' . $row['name'] .'</td>';
    }
	echo '</tr>';
	echo '<tr>';
	foreach ($payment_options['mobile'] as $row) 
	{
        echo '<td width="25%">' . $row['link'] .'</td>';
    }
	echo '</tr>';
	echo '</table>';
	
	echo "<hr>";
	echo '<h3>Internet Banking Payment</h3>';
	echo '<table width="100%">';
	echo '<tr>';
	foreach ($payment_options['internet'] as $row) 
	{
        echo '<td width="25%">' . $row['name'] .'</td>';
    }
	echo '</tr>';
	echo '<tr>';
	foreach ($payment_options['internet'] as $row) 
	{
        echo '<td width="25%">' . $row['link'] .'</td>';
    }
	echo '</tr>';
	echo '</table>';
	
	echo "<hr>";
	echo '<h3>Other Payment Options</h3>';
	echo '<table width="100%">';
	echo '<tr>';
	foreach ($payment_options['others'] as $row) 
	{
        echo '<td width="50%">' . $row['name'] .'</td>';
    }
	echo '</tr>';
	echo '<tr>';
	foreach ($payment_options['others'] as $row) 
	{
        echo '<td width="50%">' . $row['link'] .'</td>';
    }
	echo '</tr>';
	echo '</table>';	
}
?>
	</div>
    
</div>

                        <!--<div class="cart-discount">
                            <h4>Apply Discount Code</h4>
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" placeholder="Enter discount code"  required>
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-primary" type="submit">Apply Discount</button>
                                    </div>
                                </div>
                            </form>
                        </div> -->
                    </div><!-- End .col-lg-8 -->

                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h3>Choose Payment Online</h3>

							<form action="" method="post">
							
							<?php 
								
								$deliveryCharge = 50;
							
							?>

                            <table class="table table-totals">
                                <tbody>
                                    <tr>
                                        <td>SSLCOMMERZ (Visa/Master/Amex/bKash/Rocket)</td>
                                        <td>
										
										</td>
                                    </tr>

                                    <tr>
                                        <td>bKash (Manual Payment)</td>
                                        <td></td>
                                    </tr>
                                </tbody>
								
                            </table>

                            <div class="checkout-methods">
                                <button name="proceed_to_payment" type="submit" class="btn btn-block btn-sm btn-primary">Proceed to Payment</button>
                                <!--<a href="#" class="btn btn-link btn-block">Check Out with Multiple Addresses</a>-->
                            </div>
							
							</form>
							
                        </div>
                    </div>
                </div>
            </div>