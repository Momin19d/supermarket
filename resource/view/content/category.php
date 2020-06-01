<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

$control = new Controller;
$eloquent = new Eloquent;

# GET PRODUCT LIST OF A CATEGORY 
if(isset($_REQUEST['id']))
	$_SESSION['category_subcategory_id'] = $_REQUEST['id'];

if(empty($_SESSION['category_subcategory_id']))
	$_SESSION['category_subcategory_id'] = 11;

$columnName = "*";
$tableName = "products";
$whereValue['subcategory_id'] = $_SESSION['category_subcategory_id'];
$productList = $eloquent->selectData($columnName, $tableName, @$whereValue);

$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "subcategories";
$whereValue['id'] = $_SESSION['category_subcategory_id'];
$subcategoryData = $eloquent->selectData($columnName, $tableName, @$whereValue);

?>

<!-- Main Content Start -->
<main class="main">
	
	<!-- Category Section Banner Start -->
	<div class="banner banner-cat" style="background-image: url('public/assets/images/banners/banner-top.jpg');">
		<div class="banner-content container">
			<h2 class="banner-subtitle">check out over <span>200+</span></h2>
			<h1 class="banner-title">
				INCREDIBLE deals
			</h1>
			<a href="#" class="btn btn-primary">Shop Now</a>
		</div>
	</div>
	<!-- Category Section Banner End -->
	
	<!-- Page Navigation Start -->
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Men</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $subcategoryData[0]['subcategory_name']; ?></li>
			</ol>
		</div>
	</nav>
	<!-- Page Navigation End -->
	
	<!-- Category Flex Grid Section Start -->
	<div class="container">
		
		<!-- Custom Navigation Start -->
		<nav class="toolbox horizontal-filter">
			<div class="toolbox-left">
				<div class="filter-toggle">
					<span>Filters:</span>
					<a href=#>&nbsp;</a>
				</div>
			</div>
			<!--<div class="toolbox-item toolbox-sort">
				<div class="select-custom">
					<select name="orderby" class="form-control">
						<option value="menu_order" selected="selected">Default sorting</option>
						<option value="date">Sort by Newness</option>
						<option value="price">Sort by Price: Low to high</option>
						<option value="price-desc">Sort by Price: High to low</option>
					</select>
				</div>
				<a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">GO</span></a>
			</div>-->
			<div class="toolbox-item">
			</nav>
			<!-- Custom Navigation End -->
			
			<!-- ----------------------- PRODUCT ----------------------- -->
					
					<?php 
					
					if( empty($productList) )
					{
						echo '
							<div class="pull-center">
								<img src="'.$GLOBALS['IMAGE_DIRECTORY']."noproduct.png".'" />
							</div>
						';
					}
					
					?>
			
			<!-- Additionaly Added Start -->
			<div class="row products-body">
			
				<div class="col-lg-9 main-content">
					<!-- Additionaly Added End-->
					<div class="row row-sm category-grid">
					
					<!-- ----------------------- PRODUCT ----------------------- -->
					
					<?php 
					
					foreach($productList AS $eachProduct)
					{
						if(empty($eachProduct['product_master_image']))
							$productImage = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
						else
							$productImage = $GLOBALS['PRODUCT_DIRECTORY'].$eachProduct['product_master_image'];
			
					echo '
						<div class="col-6 col-md-4 col-xl-3">
							<div class="grid-product">
								<figure class="product-image-container">
									<a href="product.php?id='.$eachProduct['id'].'" class="product-image">
										<img src="'. $productImage .'" alt="product">
									</a>
									<!--<a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>-->
								</figure>
								<div class="product-details">
									<!--<div class="ratings-container">
										<div class="product-ratings">
											<span class="ratings" style="width:80%"></span>
										</div>
									</div>-->
									<h2 class="product-title">
										<a href="#">'. $eachProduct['product_name'] .'</a>
									</h2>
									<div class="price-box">
										<span class="product-price">'. $eachProduct['product_price'] .'</span>
									</div><!-- End .price-box -->
									
									<div class="product-grid-action">
										<!--<a href="#" class="paction add-wishlist" title="Add to Wishlist">
											<span>Add to Wishlist</span>
										</a>-->
										
								     <form method="post" action="">
								     <button href="cart.php" name="add_to_cart" class="paction add-cart" title="Add to Cart" type="submit">
									 <input type="hidden" name="cart_product_id" value="'. $eachProduct['id'] .'">
									 <input type="hidden" name="cart_product_quantity" value="1">
									 <span>Add to Cart</span>
								     </button>
							         </form>
										
										<!--<a href="#" class="paction add-compare" title="Add to Compare">
											<span>Add to Compare</span>
										</a>-->
									</div>
								</div>
							</div>
						</div>
						';
					}
					?>
					<!-- -----------------------PRODUCT ----------------------- -->
						
					</div>
					
					<hr>
					
					
					<!--<nav class="toolbox toolbox-pagination">
						<div class="toolbox-item toolbox-show">
							<label>Showing 1–9 of 60 results</label>
						</div>
						
						<ul class="pagination">
							<li class="page-item disabled">
								<a class="page-link page-link-btn" href="#"><i class="icon-angle-left"></i></a>
							</li>
							<li class="page-item active">
								<a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
							</li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link" href="#">4</a></li>
							<li class="page-item"><span>...</span></li>
							<li class="page-item"><a class="page-link" href="#">15</a></li>
							<li class="page-item">
								<a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
							</li>
						</ul>
					</nav>-->
					
					
				</div><!-- End .container -->
				
				<!-- Side Overlay Start -->
				<div class="sidebar-overlay"></div>
				<!-- Side Overlay Start -->
				
				<!-- Aside Section Start -->
				<aside class="sidebar-shop col-lg-3 order-lg-first">
					<div class="sidebar-wrapper">
						
						<!-- Men Section Start -->
						<div class="widget">
							<h3 class="widget-title">
								<a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Men</a>
							</h3>
							<div class="collapse show" id="widget-body-2">
								<div class="widget-body">
									<ul class="cat-list">
										<li><a href="#">Accessories</a></li>
										<li><a href="#">Watch Fashion</a></li>
										<li><a href="#">Tees, Knits & Polos</a></li>
										<li><a href="#">Pants & Denim</a></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- Men Section End -->
						
						<!-- Price Section Start -->
						<div class="widget">
							<h3 class="widget-title">
								<a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Price</a>
							</h3>
							<div class="collapse show" id="widget-body-3">
								<div class="widget-body">
									<form action="#" method="">
										<div class="price-slider-wrapper">
											<div id="price-slider"></div>
										</div>
										<div class="filter-price-action">
											<button type="submit" class="btn btn-primary">Filter</button>
											<div class="filter-price-text"> Price: <span id="filter-price-range"></span> </div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Price Section End -->
						
						<!-- Size Section Start -->
						<div class="widget">
							<h3 class="widget-title">
								<a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Size</a>
							</h3>
							<div class="collapse show" id="widget-body-4">
								<div class="widget-body">
									<ul class="cat-list">
										<li><a href="#">Small</a></li>
										<li><a href="#">Medium</a></li>
										<li><a href="#">Large</a></li>
										<li><a href="#">Extra Large</a></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- Size Section End -->
						
						<!-- Brand Section Start -->
						<div class="widget">
							<h3 class="widget-title">
								<a data-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="true" aria-controls="widget-body-5">Brand</a>
							</h3>
							<div class="collapse show" id="widget-body-5">
								<div class="widget-body">
									<ul class="cat-list">
										<li><a href="#">Adidas</a></li>
										<li><a href="#">Calvin Klein (26)</a></li>
										<li><a href="#">Diesel (3)</a></li>
										<li><a href="#">Lacoste (8)</a></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- Brand Section End -->
						
						<!-- Color Section Start -->
						<div class="widget">
							<h3 class="widget-title">
								<a data-toggle="collapse" href="#widget-body-6" role="button" aria-expanded="true" aria-controls="widget-body-6">Color</a>
							</h3>
							<div class="collapse show" id="widget-body-6">
								<div class="widget-body">
									<ul class="config-swatch-list">
										<li class="" style="">
											<a href="#"> <span class="color-panel" style="background-color: #1645f3;"></span> </a>
											<span>Blue</span>
										</li>
										<li>
											<a href="#"> <span class="color-panel" style="background-color: #f11010;"></span> </a>
											<span>Red</span>
										</li>
										<li>
											<a href="#"> <span class="color-panel" style="background-color: #fe8504;"></span> </a>
											<span>Yellow</span>
										</li>
										<li>
											<a href="#"> <span class="color-panel" style="background-color: #2da819;"></span> </a>										
											<span>Green</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- Color Section End -->
					</div>
				</aside>
				<!-- Aside Section End -->
				
			</div>
		</div>
	</div>
	
	<div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->						