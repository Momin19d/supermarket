<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Porto - Bootstrap eCommerce Template</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">
        
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="public/assets/images/icons/favicon.ico">
    
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="public/assets/css/style.min.css">
    <link rel="stylesheet" href="public/assets/css/custom.css">
	
	
</head>
<body>

<?php
####################################################################

# CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");
$eloquent = new Eloquent;

##### GET SAMPLE DATA
$columnName = "*";
$tableName = "categories";
$whereValue['category_status'] = "Active";
$categoryMenu = $eloquent->selectData($columnName, $tableName, @$whereValue);

##### ADD ITEM TO CART
# --------------
if(isset($_POST['add_to_cart']))
{
	if(@$_SESSION['SMCF_login_customer_id'] > 0)
	{
		# Is this Item Available in Cart?
		$columnName = $tableName = $whereValue = null;
		$columnName = "*";
		$tableName = "shopcarts";
		$whereValue["customer_id"] = $_SESSION['SMCF_login_customer_id']; # Customer who is logged in
		$whereValue["product_id"] = $_POST['cart_product_id']; # The Item that this Customer tried to Add
		$availabilityInCart = $eloquent->selectData($columnName, $tableName, @$whereValue);
		
		if(!empty($availabilityInCart))
		{
			# Update the Existing Item Quantiy in Cart
			$columnName = $tableName = $whereValue = null;
			$tableName = "shopcarts";
			$columnValue["quantity"] = $_POST['cart_product_quantity'] + $availabilityInCart[0]['quantity'];
			$whereValue["customer_id"] = $_SESSION['SMCF_login_customer_id'];
			$whereValue["product_id"] = $_POST['cart_product_id'];
			$updateCartResult = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			$_SESSION['ADD_TO_CART_RESULT'] = $updateCartResult;
		}
		else
		{
			# Add Item to Cart
			$tableName = "shopcarts";
			$columnValue["customer_id"] = $_SESSION['SMCF_login_customer_id'];
			$columnValue["product_id"] = $_POST['cart_product_id'];
			$columnValue["quantity"] = $_POST['cart_product_quantity'];
			$columnValue["created_at"] = date("Y-m-d H:i:s");
			$addToCartResult = $eloquent->insertData($tableName, $columnValue);
			$_SESSION['ADD_TO_CART_RESULT'] = $addToCartResult;
		}
	}
	else
	{
		$_SESSION['ADD_TO_CART_RESULT'] = 0;
		
	}
}

# --------------

##### GET CART SUMMARY DATA
$columnName = $tableName = $joinType = $onCondition = $whereValue = $formatBy = null;
$columnName["1"] = "shopcarts.quantity";
$columnName["2"] = "products.id";
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

####################################################################
?>


    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left header-dropdowns">
                        <!--<div class="header-dropdown">
                            <a href="#">USD</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="#">EUR</a></li>
                                    <li><a href="#">USD</a></li>
                                </ul>
                            </div>
                        </div> -->

                        <!-- <div class="header-dropdown">
                            <a href="#"><img src="public/assets/images/flags/en.png" alt="England flag">ENGLISH</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="#"><img src="public/assets/images/flags/en.png" alt="England flag">ENGLISH</a></li>
                                    <li><a href="#"><img src="public/assets/images/flags/fr.png" alt="France flag">FRENCH</a></li>
                                </ul>
                            </div>
                        </div> -->

                        <!--<div class="dropdown compare-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-retweet"></i> Compare (2)
                            </a>

                            <div class="dropdown-menu" >
                                <div class="dropdownmenu-wrapper">
                                    <ul class="compare-products">
                                        <li class="product">
                                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                            <h4 class="product-title"><a href="product.html">Lady White Top</a></h4>
                                        </li>
                                        <li class="product">
                                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                            <h4 class="product-title"><a href="product.html">Blue Women Shirt</a></h4>
                                        </li>
                                    </ul>

                                    <div class="compare-actions">
                                        <a href="#" class="action-link">Clear All</a>
                                        <a href="#" class="btn btn-primary">Compare</a>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>

                    <div class="header-right">
                        <p class="welcome-msg">Welcome 
							<?php 
								if(@$_SESSION['SMCF_login_customer_id'] > 0)
									echo $_SESSION['SMCF_login_customer_name']; 
								else
									echo "GUEST";
							?>! 
						</p>

                        <div class="header-dropdown dropdown-expanded">
                            <a href="#">Links</a>
                            <div class="header-menu">
                                <ul>
                                    <!--<li><a href="account.php">MY ACCOUNT </a></li>
                                    <li><a href="#">DAILY DEAL</a></li>
                                    <li><a href="#">MY WISHLIST </a></li>
                                    <li><a href="blog.html">BLOG</a></li>-->
                                    <li><a href="contact.php">Contact</a></li>
                                    <?php 
										
										if(@$_SESSION['SMCF_login_customer_id'] > 0)
										{
											# IF CUSTOMER ID IS AVAILABLE IN THE SESSION
											echo '<li><a href="?exit=yes">LOGOUT</a></li>';
										}
										else
										{
											# IF CUSTOMER ID IS NOT AVAILABLE IN THE SESSION
											echo '<li><a href="login.php"><i class="icon-user"></i>Acount</a></li>';
										}
									?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <a href="index.php" class="logo">
                            <img src="public/assets/images/logo.png" alt="Porto Logo">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                            <form action="search.php" method="post">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="keywords" id="q" placeholder="Search..." required>
                                    <!--<div class="select-custom">
                                        <select id="cat" name="cat">
                                            <option value="">All Categories</option>
                                            <option value="4">Fashion</option>
                                            <option value="12">- Women</option>
                                            <option value="13">- Men</option>
                                            <option value="66">- Jewellery</option>
                                            <option value="67">- Kids Fashion</option>
                                            <option value="5">Electronics</option>
                                            <option value="21">- Smart TVs</option>
                                            <option value="22">- Cameras</option>
                                            <option value="63">- Games</option>
                                            <option value="7">Home &amp; Garden</option>
                                            <option value="11">Motors</option>
                                            <option value="31">- Cars and Trucks</option>
                                            <option value="32">- Motorcycles &amp; Powersports</option>
                                            <option value="33">- Parts &amp; Accessories</option>
                                            <option value="34">- Boats</option>
                                            <option value="57">- Auto Tools &amp; Supplies</option>
                                        </select>
                                    </div> -->
                                    <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                                </div>
                            </form>
                        </div><!-- End .header-search -->
                    </div><!-- End .headeer-center -->

                    <div class="header-right">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <div class="header-contact">
                            <span>Hotline</span>
                            <a href="tel:#"><strong>+8801715519523</strong></a>
                        </div><!-- End .header-contact -->

					<!-- --------------------------------- TOP SHOP CART ----------------------------------- -->
                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <span class="cart-count">
								<?php
									echo count(@$myShopcartItems);
								?>
								</span>
                            </a>

                            <div class="dropdown-menu" >
                                <div class="dropdownmenu-wrapper">
                                    <div class="dropdown-cart-header">
                                        <span>
										<?php
											echo count(@$myShopcartItems);
										?>
										Items</span>

                                        <a href="cart.php">View Cart</a>
                                    </div><!-- End .dropdown-cart-header -->
                                    <div class="dropdown-cart-products">
									
									<?php 
									$subTotal = 0;
									foreach(@$myShopcartItems AS $eachCartItem)
									{
									echo '
                                        <div class="product">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                    <a href="product.html">'.$eachCartItem['product_name'].'</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">'.$eachCartItem['quantity'].'</span>
                                                    x '.$GLOBALS['CURRENCY']. ' ' . $eachCartItem['product_price'].'
                                                </span>
                                            </div>

                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <img src="'.$GLOBALS['PRODUCT_DIRECTORY'] . $eachCartItem['product_master_image'].'" alt="product">
                                                </a>
                                            </figure>
                                        </div>
										';
										$subTotal += ($eachCartItem['quantity'] * $eachCartItem['product_price']);
									}
									?>

                                    </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>Sub Total</span>

                                        <span class="cart-total-price"><?php echo $GLOBALS['CURRENCY'] . ' ' . $subTotal; ?></span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="cart.php" class="btn btn-block">Go to Cart</a>
                                    </div><!-- End .dropdown-cart-total -->
                                </div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
						
						<!-- STANDARD_MENU_BAR -->
						
                            <li class="active"><a href="index.php">Home</a></li>
							
                            <!--<li>
                                <a href="category.html" class="sf-with-ul">Categories</a>
                                <div class="megamenu megamenu-fixed-width">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="menu-title">
                                                        <a href="#">Variations 1<span class="tip tip-new">New!</span></a>
                                                    </div>
                                                    <ul>
                                                        <li><a href="category.html">Fullwidth Banner<span class="tip tip-hot">Hot!</span></a></li>
                                                        <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                                                        <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>
                                                        <li><a href="category.html">Left Sidebar</a></li>
                                                        <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                                                        <li><a href="category-flex-grid.html">Product Flex Grid</a></li>
                                                        <li><a href="category-horizontal-filter1.html">Horizontal Filter1</a></li>
                                                        <li><a href="category-horizontal-filter2.html">Horizontal Filter2</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="menu-title">
                                                        <a href="#">Variations 2</a>
                                                    </div>
                                                    <ul>
                                                        <li><a href="#">Product List Item Types</a></li>
                                                        <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll</a></li>
                                                        <li><a href="category-3col.html">3 Columns Products</a></li>
                                                        <li><a href="category.html">4 Columns Products <span class="tip tip-new">New</span></a></li>
                                                        <li><a href="category-5col.html">5 Columns Products</a></li>
                                                        <li><a href="category-6col.html">6 Columns Products</a></li>
                                                        <li><a href="category-7col.html">7 Columns Products</a></li>
                                                        <li><a href="category-8col.html">8 Columns Products</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="banner">
                                                <a href="#">
                                                    <img src="public/assets/images/menu-banner-2.jpg" alt="Menu banner">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="megamenu-container">
                                <a href="product.html" class="sf-with-ul">Products</a>
                                <div class="megamenu">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="menu-title">
                                                        <a href="#">Variations</a>
                                                    </div>
                                                    <ul>
                                                        <li><a href="product.html">Horizontal Thumbnails</a></li>
                                                        <li><a href="product-full-width.html">Vertical Thumbnails<span class="tip tip-hot">Hot!</span></a></li>
                                                        <li><a href="product.html">Inner Zoom</a></li>
                                                        <li><a href="product-addcart-sticky.html">Addtocart Sticky</a></li>
                                                        <li><a href="product-sidebar-left.html">Accordion Tabs</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="menu-title">
                                                        <a href="#">Variations</a>
                                                    </div>
                                                    <ul>
                                                        <li><a href="product-sticky-tab.html">Sticky Tabs</a></li>
                                                        <li><a href="product-simple.html">Simple Product</a></li>
                                                        <li><a href="product-sidebar-left.html">With Left Sidebar</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="menu-title">
                                                        <a href="#">Product Layout Types</a>
                                                    </div>
                                                    <ul>
                                                        <li><a href="product.html">Default Layout</a></li>
                                                        <li><a href="product-extended-layout.html">Extended Layout</a></li>
                                                        <li><a href="product-full-width.html">Full Width Layout</a></li>
                                                        <li><a href="product-grid-layout.html">Grid Images Layout</a></li>
                                                        <li><a href="product-sticky-both.html">Sticky Both Side Info<span class="tip tip-hot">Hot!</span></a></li>
                                                        <li><a href="product-sticky-info.html">Sticky Right Side Info</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="banner">
                                                <a href="#">
                                                    <img src="public/assets/images/menu-banner.jpg" alt="Menu banner" class="product-promo">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="sf-with-ul">Pages</a>

                                <ul>
                                    <li><a href="cart.html">Shopping Cart</a></li>
                                    <li><a href="#">Checkout</a>
                                        <ul>
                                            <li><a href="checkout-shipping.html">Checkout Shipping</a></li>
                                            <li><a href="checkout-shipping-2.html">Checkout Shipping 2</a></li>
                                            <li><a href="checkout-review.html">Checkout Review</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Dashboard</a>
                                        <ul>
                                            <li><a href="dashboard.html">Dashboard</a></li>
                                            <li><a href="my-account.html">My Account</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="#">Blog</a>
                                        <ul>
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="single.html">Blog Post</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="#" class="login-link">Login</a></li>
                                    <li><a href="forgot-password.html">Forgot Password</a></li>
                                </ul>
                            </li>-->
							
							<?php
							###################### MENU ######################
							
							foreach($categoryMenu AS $eachCategory)
							{
								echo '
								<li><a href="#" class="sf-with-ul">'.$eachCategory['category_name'].'</a>
									<ul>
								';
								
									##### GET SAMPLE DATA
									$columnName = $tableName = $whereValue = null;
									
									$columnName = "*";
									$tableName = "subcategories";
									$whereValue['category_id'] = $eachCategory['id'];
									$subcategoryMenu = $eloquent->selectData($columnName, $tableName, @$whereValue);
									
									foreach($subcategoryMenu AS $eachSubcategory)
									{
										echo '
											<li><a href="category.php?id='.$eachSubcategory['id'].'">'.$eachSubcategory['subcategory_name'].'</a></li>
										';
									}
										
								echo '</ul>
								</li>
								';
							}
							
							?>
							
                            <!--<li class="float-right buy-effect"><a href="#"><span>Buy Porto!</span></a></li>
                            <li class="float-right"><a href="#">Special Offer!</a></li>
							-->
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
		
		<div>
		<!-- CART ADD MESSAGE -->
		<?php 
		if(isset($_POST['add_to_cart']))
		{
			if($_SESSION['ADD_TO_CART_RESULT'] > 0)
				echo '
				<div class="alert alert-success cart-add-message">
				Thanks! Your product is added to Cart. Please <a href="cart.php">Click Here</a> to view the Cart.
				</div>
			';
			else
			{
				echo '
				<div class="alert alert-danger cart-add-message">
				Something went wrong! Please login and retry to add Item to Cart!
				</div>';
			}
			$_SESSION['ADD_TO_CART_RESULT'] = null;
		}
		?>
		<!-- CART ADD MESSAGE -->
		</div>
