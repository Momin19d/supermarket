<?php
class HomeController extends Controller
{
	public function productLister($productList)
	{
		foreach($productList AS $eachProduct)
		{
			if(empty($eachProduct['product_master_image']))
				$productImage = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
			else
				$productImage = $GLOBALS['PRODUCT_DIRECTORY'].$eachProduct['product_master_image'];
			
			echo '
            <div class="col-6 col-md-3">
                <div class="product">
                    <figure class="product-image-container">
                        <a href="product.php?id='. $eachProduct['id'] .'" class="product-image">
                            <img src="'. $productImage .'" alt="product">
                        </a>
                      
                    </figure>
                    <div class="product-details">
                       
                        <h2 class="product-title">
                            <a href="product.php?id='. $eachProduct['id'] .'">'. $eachProduct['product_name'] .'</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">'. $eachProduct['product_price'] .'</span>
                        </div>

                        <div class="product-action">
                           
							<form method="post" action="">
								<button href="cart.php" name="add_to_cart" class="paction add-cart" title="Add to Cart" type="submit">
									<input type="hidden" name="cart_product_id" value="'. $eachProduct['id'] .'">
									<input type="hidden" name="cart_product_quantity" value="1">
									<span>Add to Cart</span>
								</button>
							</form>

                           
                        </div>
                    </div>
                </div>
            </div>
			';
		}
	}
}
