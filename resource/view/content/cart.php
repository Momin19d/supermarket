 <?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");

$eloquent = new Eloquent;

#### DELETE CATEGORY
if(isset($_POST['remove_item']))
{
	# DELETE DATA #
	$tableName = "shopcarts";
	$whereValue["id"] = $_POST['cart_id'];
	$deleteResult = $eloquent->deleteData($tableName, $whereValue);
}

if(isset($_POST['update_item']))
{
	$tableName = "shopcarts";
	$columnValue["quantity"] = $_POST['quantity'];
	$whereValue["id"] = $_POST['cart_id'];
	$updateCartItem = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

$columnName = $tableName = $joinType = $onCondition = $whereValue = $formatBy = $paginate = null;
##### GET CART DATA
$columnName["1"] = "shopcarts.quantity";
$columnName["2"] = "shopcarts.id";
$columnName["3"] = "products.product_name";
$columnName["4"] = "products.product_price";
$columnName["5"] = "products.product_master_image";
$tableName["MAIN"] = "shopcarts";
$joinType = "INNER";
$tableName["1"] = "products";
$onCondition["1"] = ["shopcarts.product_id", "products.id"];
$whereValue["shopcarts.customer_id"] = @$_SESSION['SMCF_login_customer_id'];
$formatBy["DESC"] = "shopcarts.id";
$myShopcartItems = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);


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
						if(isset($_POST['update_item']))
						{
							if($updateCartItem > 0)
								echo '
								<div class="alert alert-success cart-add-message">
								The cart item is updated successfully.
								</div>
							';
						}
						?>
						<!-- CART ADD MESSAGE -->
					
                        <div class="cart-table-container">
                            <table class="table table-cart">
                                <thead>
                                    <tr>
                                        <th class="product-col">Product</th>
                                        <th class="price-col">Price</th>
                                        <th class="qty-col">Qty</th>
                                        <th class="qty-col">Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

								<?php 
								
								$cartSubTotal = 0;
								
								foreach($myShopcartItems AS $eachCartItem)
								{
									# CAT SUBTOTAL CALCULATION
									$eachItemSubtotal = $eachCartItem['product_price'] * $eachCartItem['quantity'];
									$cartSubTotal = $cartSubTotal + $eachItemSubtotal;
									
								echo '<form method="post" action="">
                                    <tr class="product-row">
                                        <td class="product-col">
											
                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <img class="" src="'.$GLOBALS['PRODUCT_DIRECTORY'].$eachCartItem['product_master_image'].'" alt="product">
                                                </a>
                                            </figure>
                                            <h2 class="product-title">
                                                <a href="#">'.$eachCartItem['product_name'].'</a>
                                            </h2>
                                        </td>
                                        <td>'.$GLOBALS['CURRENCY']. ' ' . $eachCartItem['product_price'] .'</td>
                                        <td>
                                            <input name="quantity" class="form-control cart-quantity" type="number" value="'.@$eachCartItem['quantity'].'">
                                        </td>
                                        <td>'.$GLOBALS['CURRENCY'] . ' ' . $eachItemSubtotal .'</td>
										<td>
												<input type="hidden" name="cart_id" value="'.$eachCartItem['id'].'" />
												<button name="update_item" title="Edit Product" type="submit">Update</button>
												<button name="remove_item" title="Remove Product" type="submit">Remove</button>
											
										</td>
                                    </tr>
									</form>
									';
								}
									
								?>
                                    

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="clearfix">
                                            <div class="float-left">
                                                <a href="index.php" class="btn btn-outline-secondary">Continue Shopping</a>
                                            </div><!-- End .float-left -->

                                            <div class="float-right">
                                                <!--<a href="#" class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                                <a href="#" class="btn btn-outline-secondary btn-update-cart">Update Shopping Cart</a>-->
                                            </div><!-- End .float-right -->
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- End .cart-table-container -->

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
                            <h3>Summary</h3>

							<!--
                            <h4>
                                <a data-toggle="collapse" href="#total-estimate-section" class="collapsed" role="button" aria-expanded="false" aria-controls="total-estimate-section">Estimate Shipping and Tax</a>
                            </h4>
							
                            <div class="collapse" id="total-estimate-section">
                                <form action="#">
                                    <div class="form-group form-group-sm">
                                        <label>Country</label>
                                        <div class="select-custom">
                                            <select class="form-control form-control-sm">
                                                <option value="USA">United States</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="China">China</option>
                                                <option value="Germany">Germany</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label>State/Province</label>
                                        <div class="select-custom">
                                            <select class="form-control form-control-sm">
                                                <option value="CA">California</option>
                                                <option value="TX">Texas</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label>Zip/Postal Code</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group form-group-custom-control">
                                        <label>Flat Way</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="flat-rate">
                                            <label class="custom-control-label" for="flat-rate">Fixed $5.00</label>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-custom-control">
                                        <label>Best Rate</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="best-rate">
                                            <label class="custom-control-label" for="best-rate">Table Rate $15.00</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
							-->
							
							<form action="order.php" method="post">
							
							<?php 
								
								$deliveryCharge = 50;
							
							?>

                            <table class="table table-totals">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>
										<?php 
										echo $GLOBALS['CURRENCY'] . ' ' . $cartSubTotal; 
										
										?>
										</td>
                                    </tr>

                                    <tr>
                                        <td>Delivery Charge</td>
                                        <td><?php echo $GLOBALS['CURRENCY'] . ' ' . $deliveryCharge; ?> </td>
                                    </tr>
                                </tbody>
								
								<?php 
								# GRAND TOTAL CALCULATION
								$grandTotal = $cartSubTotal + $deliveryCharge;
								?>
								
                                <tfoot>
                                    <tr>
                                        <td>Grand Total</td>
                                        <td>
										<?php 
										echo $GLOBALS['CURRENCY'] . ' ' . $grandTotal; 
										
										?>
										</td>
                                    </tr>
                                </tfoot>
                            </table>
							
							<input type="hidden" name="sub_total" value="<?php echo @$cartSubTotal; ?>" />
							<input type="hidden" name="delivery_charge" value="<?php echo @$deliveryCharge; ?>" />
							<input type="hidden" name="grand_total" value="<?php echo @$grandTotal; ?>" />

                            <div class="checkout-methods">
                                <button name="submit_order" type="submit" class="btn btn-block btn-sm btn-primary">Proceed to Order</button>
                                <!--<a href="#" class="btn btn-link btn-block">Check Out with Multiple Addresses</a>-->
                            </div>
							
							</form>
							
                        </div>
                    </div>
                </div>
            </div>