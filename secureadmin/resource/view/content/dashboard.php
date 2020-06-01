<?php
# CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/DashboardController.php");

# CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$dashboard = new DashboardController;
$eloquent = new Eloquent;

?>

<!-- page heading start-->
<!-- <div class="page-heading">
	Dashboard
</div> -->
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper">
	<div class="row states-info">
		<div class="col-md-3">
			<div class="panel red-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-money"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Dollar Profit Today </span>
							<h4>$ 23,232</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel blue-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-tag"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title">  Copy Sold Today  </span>
							<h4>2,980</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel green-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-gavel"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title">  New Order  </span>
							<h4>5980</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel yellow-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-eye"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title">  Unique Visitors  </span>
							<h4>10,000</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--body wrapper end-->
	
	<!--body wrapper start-->
	<div class="wrapper">
		<!--	
            <div class="row">
			<div class="col-sm-12">
			<section class="panel">
			<header class="panel-heading">
			Bar Chart
			<span class="tools pull-right">
			<a href="javascript:;" class="fa fa-chevron-down"></a>
			<a href="javascript:;" class="fa fa-times"></a>
			</span>
			</header>
			<div class="panel-body">
			<div id="graph-bar"></div>
			</div>
			</section>
			</div>
            </div>
		-->
		<div class="row">
			<div class="col-sm-12">
				<section class="panel">
					<header class="panel-heading">
						Line Chart
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
						</span>
					</header>
					<div class="panel-body">
						Habijabi
					</div>
				</section>
			</div>
		</div>
	</div>
	<!--body wrapper end-->