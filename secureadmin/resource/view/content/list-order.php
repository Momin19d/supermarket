<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");

$orderCtrl = new Controller;
$eloquent = new Eloquent;

#### List of Orders
$columnName["1"] = "customers.customer_name";
$columnName["2"] = "customers.customer_email";
$columnName["3"] = "customers.customer_mobile";
$columnName["4"] = "customers.customer_address";
$columnName["5"] = "order_item.id";
$columnName["6"] = "order_item.order_item_status";
$columnName["7"] = "orders.payment_method";
$tableName["MAIN"] = "order_item";
$joinType = "INNER";
$tableName["1"] = "customers";
$tableName["2"] = "orders";
$onCondition["1"] = ["order_item.customer_id", "customers.id"];
$onCondition["2"] = ["order_item.order_id", "orders.id"];
$whereValue["order_item.id"] = "1";

$queryResult = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);

?>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			
			<!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Order List</li>
			</ul>
			<!--breadcrumbs end -->
			
			<section class="panel">
				<header class="panel-heading">
					ORDER'S LIST
				</header>
				<div class="panel-body">
					<div class="adv-table">
						<table  class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th>Order ID</th>
									<th>Customer Name</th>
									<th>Customer Email</th>
									<th>Customer Mobile</th>
									<th>Customer Address</th>
									<th>Order Status</th>
									<th>Payment Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									/*
										$n = 1;
										foreach ($orderList as $eachRow) 
										{
										echo '
										<tr class="gradeA">
										<td>'.$n.'</td>
										<td>'.$eachRow["customer_name"].'</td>
										<td>'.$eachRow["customer_email"].'</td>
										<td>'.$eachRow["customer_mobile"].'</td>
										<td>'.$eachRow["customer_address"].'</td>
										<td class="center"><select><option>'.$eachRow["order_item_status"].'</option></select></td>
										<td class="center">'.$eachRow["payment_method"].'</td>
										<td class="center">
										<a href="detail-order.php"><button class="btn btn-warning btn-sm" type="submit"><i class="fa fa-chevron-circle-left"></i> Details</button></a>
										</td>
										</tr> 
										';
										$n++;
										}
									*/
								?>
							</tbody>
							<tfoot>
								<tr>
									<th>Order ID</th>
									<th>Customer Name</th>
									<th>Customer Email</th>
									<th>Customer Mobile</th>
									<th>Customer Address</th>
									<th>Order Status</th>
									<th>Payment Status</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->