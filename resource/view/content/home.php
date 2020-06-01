<?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");

$eloquent = new Eloquent;
$homeCtrl = new HomeController;

##### SLIDER DATA
$columnName = "*";
$tableName = "slides";
$slidesList = $eloquent->selectData($columnName, $tableName);

##### MENS PRODUCT LIST
$columnName = $tableName = $whereValue = null;

$columnName["1"] = "id";
$columnName["2"] = "product_name";
$columnName["3"] = "product_price";
$columnName["4"] = "product_master_image";
$tableName = "products";
$whereValue["category_id"] = 19; # Men's Category ID
$whereValue["product_status"] = "In Stock";
$formatBy["DESC"] = "id";
$paginate["POINT"] = 0;
$paginate["LIMIT"] = 4;
$menProducts = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);

##### MENS PRODUCT LIST
$columnName = $tableName = $whereValue = $inColumn = $inValue = $formatBy = $paginate = null;

$columnName["1"] = "id";
$columnName["2"] = "product_name";
$columnName["3"] = "product_price";
$columnName["4"] = "product_master_image";
$tableName = "products";
$whereValue["category_id"] = 20; # Women's Category ID
$whereValue["product_status"] = "In Stock";
$formatBy["DESC"] = "id";
$paginate["POINT"] = 0;
$paginate["LIMIT"] = 4;
$womenProducts = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);

##### MENS PRODUCT LIST
$columnName = $tableName = $whereValue = $inColumn = $inValue = $formatBy = $paginate = null;

$columnName["1"] = "id";
$columnName["2"] = "product_name";
$columnName["3"] = "product_price";
$columnName["4"] = "product_master_image";
$tableName = "products";
$whereValue["category_id"] = 21; # Kid's Category ID
$whereValue["product_status"] = "In Stock";
$formatBy["DESC"] = "id";
$paginate["POINT"] = 0;
$paginate["LIMIT"] = 4;
$kidProducts = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);

?>

        <main class="main">
			
			
            <div class="home-top-container">
                <div class="container">
				
                    <div class="row">
					
                        <div class="col-lg-12">
						
                            <div class="home-slider owl-carousel owl-carousel-lazy">
							
							<?php 
							foreach($slidesList AS $eachSlide)
							{
								echo '
                                <div class="home-slide">
                                    <img class="owl-lazy" src="public/assets/images/lazy.png" data-src="'.$GLOBALS['SLIDES_DIRECTORY'] . $eachSlide['slider_file'].'" alt="slider image">
                                    <div class="home-slide-content">
                                        <h1>'.$eachSlide['slider_title'].'</h1>
                                    </div>
                                </div>
								';
							}
							?>

                            </div>
							
                        </div>

                        <!-- <div class="col-lg-4 top-banners">
                            <div class="banner banner-image">
                                <a href="#">
                                    <img src="public/assets/images/banners/banner-1.jpg" alt="banner">
                                </a>
                            </div>

                            <div class="banner banner-image">
                                <a href="#">
                                    <img src="public/assets/images/banners/banner-2.jpg" alt="banner">
                                </a>
                            </div>

                            <div class="banner banner-image">
                                <a href="#">
                                    <img src="public/assets/images/banners/banner-3.jpg" alt="banner">
                                </a>
                            </div>
                        </div> -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .home-top-container -->

            <div class="info-boxes-container">
                <div class="container">
                    <div class="info-box">
                        <i class="icon-shipping"></i>

                        <div class="info-box-content">
                            <h4>FREE SHIPPING & RETURN</h4>
                            <p>Free shipping on all orders over $99.</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box">
                        <i class="icon-us-dollar"></i>

                        <div class="info-box-content">
                            <h4>MONEY BACK GUARANTEE</h4>
                            <p>100% money back guarantee</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box">
                        <i class="icon-support"></i>

                        <div class="info-box-content">
                            <h4>ONLINE SUPPORT 24/7</h4>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->

            <div class="container">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="featured-products-tab" data-toggle="tab" href="#featured-products" role="tab" aria-controls="featured-products" aria-selected="true">Men</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="featured-products" role="tabpanel" aria-labelledby="featured-products-tab">
                                    <div class="row row-sm">
									
									<?php 
										$homeCtrl->productLister($menProducts);
									?>
                                        

                                    </div>
                                </div>
                                
                            </div>
                        </div>


                    </div>
  
                </div>
            
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="featured-products-tab" data-toggle="tab" href="#featured-products" role="tab" aria-controls="featured-products" aria-selected="true">Women</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="featured-products" role="tabpanel" aria-labelledby="featured-products-tab">
                                    <div class="row row-sm">
									
                                    <?php 
										$homeCtrl->productLister($womenProducts);
									?>

                                    </div><!-- End .row -->
                                </div><!-- End .tab-pane -->
                                
                            </div><!-- End .tab-content -->
                        </div><!-- End .home-product-tabs -->


                    </div><!-- End .col-lg-9 -->
  
                </div><!-- End .row -->
            
			
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="featured-products-tab" data-toggle="tab" href="#featured-products" role="tab" aria-controls="featured-products" aria-selected="true">Kids</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="featured-products" role="tabpanel" aria-labelledby="featured-products-tab">
                                    <div class="row row-sm">
									
                                        <?php 
											$homeCtrl->productLister($kidProducts);
										?>

                                    </div><!-- End .row -->
                                </div><!-- End .tab-pane -->
                                
                            </div><!-- End .tab-content -->
                        </div><!-- End .home-product-tabs -->

                    </div><!-- End .col-lg-9 -->
  
                </div><!-- End .row -->
            
                        <div class="banners-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="banner banner-image">
                                        <a href="#">
                                            <img src="public/assets/images/banners/banner-4.jpg" alt="banner">
                                        </a>
                                    </div><!-- End .banner -->

                                    <div class="banner banner-image">
                                        <a href="#">
                                            <img src="public/assets/images/banners/banner-5.jpg" alt="banner">
                                        </a>
                                    </div><!-- End .banner -->
                                </div><!-- End .col-md-4 -->

                                <div class="col-md-8">
                                    <div class="banner banner-image">
                                        <a href="#">
                                            <img src="public/assets/images/banners/banner-6.jpg" alt="banner">
                                        </a>
                                    </div><!-- End .banner -->
                                </div><!-- End .col-md-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .banners-group -->
			
			</div><!-- End .container -->
			
			

            <div class="mb-4"></div><!-- margin -->

            <div class="partners-container">
                <div class="container">
                    <div class="partners-carousel owl-carousel owl-theme">
                        <a href="#" class="partner">
                            <img src="public/assets/images/logos/1.png" alt="logo">
                        </a>
                        <a href="#" class="partner">
                            <img src="public/assets/images/logos/2.png" alt="logo">
                        </a>
                        <a href="#" class="partner">
                            <img src="public/assets/images/logos/3.png" alt="logo">
                        </a>
                        <a href="#" class="partner">
                            <img src="public/assets/images/logos/4.png" alt="logo">
                        </a>
                        <a href="#" class="partner">
                            <img src="public/assets/images/logos/5.png" alt="logo">
                        </a>
                        <a href="#" class="partner">
                            <img src="public/assets/images/logos/2.png" alt="logo">
                        </a>
                        <a href="#" class="partner">
                            <img src="public/assets/images/logos/1.png" alt="logo">
                        </a>
                    </div><!-- End .partners-carousel -->
                </div><!-- End .container -->
            </div><!-- End .partners-container -->
        </main><!-- End .main -->
