 <?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");
include("app/Http/Controllers/SSLCommerz.php");

$eloquent = new Eloquent;

?>

       <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-1">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Status Page</li>
                    </ol>
                </div><!-- End .container -->
            </nav>


            <div class="container">
                <div class="row">
				
                    <div class="col-lg-12">
					
<?php 

################### PAYMENT VERIFICATION ###################
$sslc = new SSLCommerz();
$tran_id = $_SESSION['payment_values']['tran_id'];
$amount = $_SESSION['payment_values']['amount'];
$currency = $_SESSION['payment_values']['currency'];

$validation = $sslc->orderValidate($tran_id, $amount, $currency, $_POST);

if($validation == TRUE)
{
	echo '
	<div class="alert alert-success">
		Thank you for the payment.<br><br>
		We have received your payment, and soon your Product will be Delivered!
	</div>
	';
	
	##### SEND SMS #####
	$url = "http://66.45.237.70/api.php";
	$number = "8801955778822";
	$text = "Thank you for your payment against the Order No #" . $_SESSION['payment_values']['tran_id'] . ". Soon your product will be delivered.";
	$data= array(
	'username' => "markgroup",
	'password' => "0000",
	'number' => "$number",
	'message' => "$text"
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$smsResult = curl_exec($ch);
	$result = explode("|", $smsResult);
	$sendStatus = $result[0];
	##### SEND SMS #####

}
else
{
	echo '
	<div class="alert alert-success">
		Sorry! We didn\'t receive your payment! <br><br>
		If you are facing any difficulty, contact our Support Team!
	</div>
	';
}

################### PAYMENT VERIFICATION ###################

?>
					
					<hr>

                    </div>

                </div>
            </div>