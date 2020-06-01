 <?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");

$eloquent = new Eloquent;
if(isset($_REQUEST['id']))
    $_SESSION['product_id'] = $_REQUEST['id'];

#======================= FUNTION FOR SELECT ALL PRODUCT DETAILS===================#
$columnName = "*";
$tableName = "products";
$whereValue['id']=$_SESSION['product_id'];
$productDetails = $eloquent->selectData($columnName, $tableName, @$whereValue);

#================FUNCTION FOR RELATED PRODUCT====================#
$columnName= $tableName= $whereValue= null;
$columnName = "*";
$tableName = "products";
$whereValue['category_id']= $productDetails[0]['category_id'];
$paginate["POINT"] = 0;
$paginate["LIMIT"] = 2;
$relaventProducts = $eloquent->selectData($columnName, $tableName, @$whereValue, @$paginate);

#=================FUNTION FOR FEATURED PRODUCT =========================#
$columnName= $tableName= $whereValue= $paginate= null;
$columnName = "*";
$tableName = "products";
$whereValue['category_id']= $productDetails[0]['category_id'];
$whereValue['featured_product']= "Yes";
$paginate["POINT"] = 0;
$paginate["LIMIT"] = 2;
$featuredProducts = $eloquent->selectData($columnName, $tableName, @$whereValue, @$paginate);

#=================FUNCTION FOR DAYNAMIC BREADCRUMB========================#
    $columnName= $tableName= $whereValue= $paginate= null;
    $columnName["1"] = "categories.category_name";
    $columnName["2"] = "subcategories.subcategory_name";
    $columnName["3"] = "products.product_name";
    $tableName["MAIN"] = "products";
    $joinType = "INNER";
    $tableName["1"] = "categories";
    $tableName["2"] = "subcategories";
    $onCondition["1"] = ["products.category_id", "categories.id"];
    $onCondition["2"] = ["products.subcategory_id", "subcategories.id"];
    $whereValue["products.id"] = $_SESSION['product_id'];
    $breadcrumbName = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);
?>



<main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#"><?php echo $breadcrumbName[0]['category_name'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumbName[0]['subcategory_name'] ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumbName[0]['product_name'] ?></li>
                    </ol>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-single-container product-single-default">
                            <div class="row">
                                <div class="col-lg-7 col-md-6 product-single-gallery">
                                    <div class="product-slider-container product-item">
                                        <div class="product-single-carousel owl-carousel owl-theme">
                                            <div class="product-item">
                                                <img class="product-single-image" src="<?php echo $GLOBALS['PRODUCT_DIRECTORY'].$productDetails[0]['product_master_image']?>" data-zoom-image="<?php echo $GLOBALS['PRODUCT_DIRECTORY'].$productDetails[0]['product_master_image']?>"/>
                                            </div>
                                            
                                        </div>
                                        
                                        <span class="prod-full-screen">
                                            <i class="icon-plus"></i>
                                        </span>
                                    </div>
                                    <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                                        <div class="col-3 owl-dot">
                                            <img src="<?php echo $GLOBALS['PRODUCT_DIRECTORY'].$productDetails[0]['product_master_image']?>"/>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-6">
                                    <div class="product-single-details">
                                        <h1 class="product-title"><?php echo $productDetails[0]['product_name'] ?></h1>

                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:60%"></span>
                                            </div>

                                            <a href="#" class="rating-link">( 6 Reviews )</a>
                                        </div>

                                        <div class="price-box">
                                            <span class="old-price"></span>
                                            <span class="product-price"><?php echo $GLOBALS['CURRENCY'].$productDetails[0]['product_price'] ?></span>
                                        </div>

                                        <div class="product-desc">
                                            <p><?php echo $productDetails[0]['product_summary'] ?></p>
                                        </div>

                                        <div class="product-filters-container">
                                            <div class="product-single-filter">
                                                <label>Colors:</label>
                                                <ul class="config-swatch-list">
                                                    <li class="active">
                                                        <a href="#" style="background-color: #6085a5;"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" style="background-color: #ab6e6e;"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" style="background-color: #b19970;"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" style="background-color: #11426b;"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="product-action product-all-icons">
                                            <div class="product-single-qty">
                                                <input class="horizontal-quantity form-control" type="text">
                                            </div>

                                            <a href="cart.php" class="paction add-cart" title="Add to Cart">
                                                <span>Add to Cart</span>
                                            </a>
                                            <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                                <span>Add to Wishlist</span>
                                            </a>
                                            <a href="#" class="paction add-compare" title="Add to Compare">
                                                <span>Add to Compare</span>
                                            </a>
                                        </div>

                                        <div class="product-single-share">
                                            <label>Share:</label>
                                            
                                            <div class="addthis_inline_share_toolbox"></div>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                        </div>

                        <div class="product-single-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Tags</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                                    <div class="product-desc-content">
                                        <?php echo $productDetails[0]['product_details'] ?>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                                    <div class="product-tags-content">
                                        <form action="#">
                                            <h4>Add Your Tags:</h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm" required>
                                                <input type="submit" class="btn btn-primary" value="Add Tags">
                                            </div>
                                        </form>
                                        <p class="note">Use spaces to separate tags. Use single quotes (') for phrases.</p>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                                    <div class="product-reviews-content">
                                        <div class="collateral-box">
                                            <ul>
                                                <li>Be the first to review this product</li>
                                            </ul>
                                        </div><!-- End .collateral-box -->

                                        <div class="add-product-review">
                                            <h3 class="text-uppercase heading-text-color font-weight-semibold">WRITE YOUR OWN REVIEW</h3>
                                            <p>How do you rate this product? *</p>

                                            <form action="#">
                                                <div class="form-group">
                                                    <label>Nickname <span class="required">*</span></label>
                                                    <input type="text" class="form-control form-control-sm" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Summary of Your Review <span class="required">*</span></label>
                                                    <input type="text" class="form-control form-control-sm" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Review <span class="required">*</span></label>
                                                    <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                                </div>

                                                <input type="submit" class="btn btn-primary" value="Submit Review">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-overlay"></div>
                    <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
                    <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
                        <div class="sidebar-wrapper">
                            <div class="widget widget-brand">
                                <a href="#">
                                    <img src="public/assets/images/product-brand.png" alt="brand name">
                                </a>
                            </div>

                            <div class="widget widget-info">
                                <ul>
                                    <li>
                                        <i class="icon-shipping"></i>
                                        <h4>FREE<br>SHIPPING</h4>
                                    </li>
                                    <li>
                                        <i class="icon-us-dollar"></i>
                                        <h4>100% MONEY<br>BACK GUARANTEE</h4>
                                    </li>
                                    <li>
                                        <i class="icon-online-support"></i>
                                        <h4>ONLINE<br>SUPPORT 24/7</h4>
                                    </li>
                                </ul>
                            </div>

                            <div class="widget widget-banner">
                                <div class="banner banner-image">
                                    <a href="#">
                                        <img src="public/assets/images/banners/banner-sidebar.jpg" alt="Banner Desc">
                                    </a>
                                </div>
                            </div>
                            
                            <div class="widget widget-featured">
                                <h3 class="widget-title">Featured Products</h3>  
                                <div class="widget-body">
                                    <div class="owl-carousel widget-featured-products">
                                     <?php 
                                     
                                        foreach($featuredProducts AS $eachProduct){
                                        echo'
                                        <div class="featured-col">
                                            <div class="product product-sm">
                                                <figure class="product-image-container">
                                                    <a href="product.php?id='.$eachProduct['id'].'" class="product-image">
                                                        <img src="'.$GLOBALS['PRODUCT_DIRECTORY'].$eachProduct['product_master_image'].'" alt="product">
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h2 class="product-title">
                                                        <a href="product.php?id='.$eachProduct['id'].'">'.$eachProduct['product_name'].'</a>
                                                    </h2>
                                                    <div class="ratings-container">
                                                        <div class="product-ratings">
                                                            <span class="ratings" style="width:80%"></span>
                                                        </div>
                                                    </div>
                                                    <div class="price-box">
                                                        <span class="product-price">'.$GLOBALS['CURRENCY']." ".$eachProduct['product_price'].'</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>  
                            
 
                        </div>
                    </aside>
                </div>
            </div>

        <div class="featured-section">
            <div class="container">
                    <h2 class="carousel-title">Related Products</h2>

                <div class="featured-products owl-carousel owl-theme owl-dots-top">
                
                <?php 
					foreach($relaventProducts AS $eachRelvantProduct)
					{
						echo '
                        <div class="product">
                            <figure class="product-image-container">
                                <a href="product.php?id='.$eachRelvantProduct['id'].'" class="product-image">
                                    <img src="'. $GLOBALS['PRODUCT_DIRECTORY'] . $eachRelvantProduct['product_master_image'] .'" alt="product">
                                </a>
                                <!--<a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>-->
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:80%"></span>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.php?id='.$eachRelvantProduct['id'].'">'.$eachRelvantProduct['product_name'].'</a>
                                </h2>
                                <div class="price-box">
                                    <span class="product-price">'. $GLOBALS['CURRENCY'] . " " . $eachRelvantProduct['product_price'] .'</span>
                                </div>

                                <div class="product-action">
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
						';
					}
						
					?>
                </div>
            </div>
        </div>
</main>

 