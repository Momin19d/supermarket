<!DOCTYPE html>
<html lang="en">
	
	<!-- Mirrored from adminex.themebucket.net/blank_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Sep 2015 19:55:06 GMT -->
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="ThemeBucket">
		<link rel="shortcut icon" href="public/images/logo_icon.png" type="image/png">
		
		<title>SuperMarket | Online Retail Store</title>

		<!-- Summernote Start -->
		<link href="public/summernote/summernote-lite.min.css" rel="stylesheet">
		<script src="public/summernote/summernote-lite.min.js"></script>
		<!-- Summernote End -->
		
		<link href="public/css/style.css" rel="stylesheet">
		<link href="public/css/style-responsive.css" rel="stylesheet">
		
		<link href="public/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
		<link href="public/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
		<link rel="stylesheet" href="public/js/data-tables/DT_bootstrap.css" />
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="public/js/html5shiv.js"></script>
			<script src="public/js/respond.min.js"></script>
		<![endif]-->
		
	</head>
	
	<body class="sticky-header">
		
		<section>
			<!-- left side start-->
			<div class="left-side sticky-left-side">
				
				<!--logo and iconic logo start-->
				<div class="logo">
					<a href="dashboard.php"><img src="public/images/logo.png" alt=""></a>		<!--here i just edit for click on logo it's come to homepage-->
				</div>
				<div class="logo-icon text-center">
					<a href="index-2.html"><img src="public/images/logo_icon.png" alt=""></a>
				</div>
				<!--logo and iconic logo end-->
				
				<div class="left-side-inner">
					<!-- visible to small devices only -->
					<div class="visible-xs hidden-sm hidden-md hidden-lg">
						<div class="media logged-user">
							<img alt="" src="public/images/photos/user-avatar.png" class="media-object">
							<div class="media-body">
								<h4><a href="#">John Doe</a></h4>
								<span>"Hello There..."</span>
							</div>
						</div>
						<h5 class="left-nav-title">Account Information</h5>
						<ul class="nav nav-pills nav-stacked custom-nav">
							<li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
							<li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
							<li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
						</ul>
					</div>
					
					<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						
						<li><a href="dashboard.php"><i class="fa fa-home"></i> <span>Dashboard</span></a> </li>
						
						<?php 
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator")
							{
								echo '
								<li class="menu-list"><a href="#"><i class="fa fa-user"></i> <span>Manage Admin</span></a>
								<ul class="sub-menu-list">
								<li><a href="create-admin.php"> <i class="fa fa-plus-circle"></i> Create Admin</a></li>
								<li><a href="list-admin.php"> <i class="fa fa-user"></i> List Admin</a></li>
								</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Content Manager")
							{
								echo '
								<li class="menu-list"><a href="#"><i class="fa fa-picture-o"></i></i> <span>Manage Slider</span></a>
								<i class="fas fa-sliders-h"></i>
								<ul class="sub-menu-list">
								<li><a href="create-slider.php"> Add Image Slider</a></li>
								<li><a href="list-slider.php"> List Image Slider</a></li>
								</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager")
							{
								echo '
								<li class="menu-list"><a href="#"><i class="fa fa-users"></i> <span>Manage Customer</span></a>
								<ul class="sub-menu-list">
								<li><a href="list-customer.php"> Customer List </a></li>
								</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator")
							{
								echo '
								<li class="menu-list"><a href="#"><i class="fa fa-folder-open"></i> <span>Manage Category</span></a>
								<ul class="sub-menu-list">
								<li><a href="create-category.php"> Create Category</a></li>
								<li><a href="list-category.php"> List Category</a></li>
								</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator")
							{
								echo '
								<li class="menu-list"><a href="#"><i class="fa fa-list-alt"></i> <span>Manage Sub Category</span></a>
								<ul class="sub-menu-list">
								<li><a href="create-subcategory.php"> Create Sub Category</a></li>
								<li><a href="list-subcategory.php"> Sub Category List</a></li>
								</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Content Manager")
							{
								echo '
								<li class="menu-list"><a href="#"><i class="fa fa-th"></i> <span>Manage Products</span></a>
								<ul class="sub-menu-list">
								<li><a href="create-product.php"> Create Products</a></li>
								<li><a href="list-product.php"> Products List </a></li>
								</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager")
							{
								echo '
								<li class="menu-list"><a href="#"><i class="fa fa-tags"></i> <span>Manage Orders</span></a>	<i class="fas fa-sort-amount-up-alt"></i>
								<ul class="sub-menu-list">
								<li><a href="list-order.php"> Orders List</a></li>
								<li><a href="detail-order.php"> Details Orders</a></li>
								</ul>
								</li>
								';
							}
						?>
					</ul>
					<!--sidebar nav end-->
				</div>
			</div>
			<!-- left side end-->
			
			<!-- main content start-->
			<div class="main-content" >
				<!-- header section start-->
				<div class="header-section">
					<!--toggle button start-->
					<a class="toggle-btn"><i class="fa fa-bars"></i></a>
					<!--toggle button end-->
					
					<!--search start-->
					<!--
						<form class="searchform" action="http://adminex.themebucket.net/index.html" method="post">
						<input type="text" class="form-control" name="keyword" placeholder="Search here..." />
						</form>
					-->
					<!--search end-->
					
					<!--notification menu start -->
					<div class="menu-right">
						<ul class="notification-menu">
							<!-- <li>
								<a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
								<i class="fa fa-tasks"></i>
								<span class="badge">8</span>
								</a>
								<div class="dropdown-menu dropdown-menu-head pull-right">
								<h5 class="title">You have 8 pending task</h5>
								<ul class="dropdown-list user-list">
								<li class="new">
								<a href="#">
								<div class="task-info">
								<div>Database update</div>
								</div>
								<div class="progress progress-striped">
								<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
								<span class="">40%</span>
								</div>
								</div>
								</a>
								</li>
								<li class="new">
								<a href="#">
								<div class="task-info">
								<div>Dashboard done</div>
								</div>
								<div class="progress progress-striped">
								<div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
								<span class="">90%</span>
								</div>
								</div>
								</a>
								</li>
								<li>
								<a href="#">
								<div class="task-info">
								<div>Web Development</div>
								</div>
								<div class="progress progress-striped">
								<div style="width: 66%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="66" role="progressbar" class="progress-bar progress-bar-info">
								<span class="">66% </span>
								</div>
								</div>
								</a>
								</li>
								<li>
								<a href="#">
								<div class="task-info">
								<div>Mobile App</div>
								</div>
								<div class="progress progress-striped">
								<div style="width: 33%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="33" role="progressbar" class="progress-bar progress-bar-danger">
								<span class="">33% </span>
								</div>
								</div>
								</a>
								</li>
								<li>
								<a href="#">
								<div class="task-info">
								<div>Issues fixed</div>
								</div>
								<div class="progress progress-striped">
								<div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar">
								<span class="">80% </span>
								</div>
								</div>
								</a>
								</li>
								<li class="new"><a href="#">See All Pending Task</a></li>
								</ul>
								</div>
								</li>
								<li>
								<a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
								<i class="fa fa-envelope-o"></i>
								<span class="badge">5</span>
								</a>
								<div class="dropdown-menu dropdown-menu-head pull-right">
								<h5 class="title">You have 5 Mails </h5>
								<ul class="dropdown-list normal-list">
								<li class="new">
								<a href="#">
								<span class="thumb"><img src="public/images/photos/user1.png" alt="" /></span>
								<span class="desc">
								<span class="name">John Doe <span class="badge badge-success">new</span></span>
								<span class="msg">Lorem ipsum dolor sit amet...</span>
								</span>
								</a>
								</li>
								<li>
								<a href="#">
								<span class="thumb"><img src="public/images/photos/user2.png" alt="" /></span>
								<span class="desc">
								<span class="name">Jonathan Smith</span>
								<span class="msg">Lorem ipsum dolor sit amet...</span>
								</span>
								</a>
								</li>
								<li>
								<a href="#">
								<span class="thumb"><img src="public/images/photos/user3.png" alt="" /></span>
								<span class="desc">
								<span class="name">Jane Doe</span>
								<span class="msg">Lorem ipsum dolor sit amet...</span>
								</span>
								</a>
								</li>
								<li>
								<a href="#">
								<span class="thumb"><img src="public/images/photos/user4.png" alt="" /></span>
								<span class="desc">
								<span class="name">Mark Henry</span>
								<span class="msg">Lorem ipsum dolor sit amet...</span>
								</span>
								</a>
								</li>
								<li>
								<a href="#">
								<span class="thumb"><img src="public/images/photos/user5.png" alt="" /></span>
								<span class="desc">
								<span class="name">Jim Doe</span>
								<span class="msg">Lorem ipsum dolor sit amet...</span>
								</span>
								</a>
								</li>
								<li class="new"><a href="#">Read All Mails</a></li>
								</ul>
								</div>
								</li>
								<li>
								<a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<span class="badge">4</span>
								</a>
								<div class="dropdown-menu dropdown-menu-head pull-right">
								<h5 class="title">Notifications</h5>
								<ul class="dropdown-list normal-list">
								<li class="new">
								<a href="#">
								<span class="label label-danger"><i class="fa fa-bolt"></i></span>
								<span class="name">Server #1 overloaded.  </span>
								<em class="small">34 mins</em>
								</a>
								</li>
								<li class="new">
								<a href="#">
								<span class="label label-danger"><i class="fa fa-bolt"></i></span>
								<span class="name">Server #3 overloaded.  </span>
								<em class="small">1 hrs</em>
								</a>
								</li>
								<li class="new">
								<a href="#">
								<span class="label label-danger"><i class="fa fa-bolt"></i></span>
								<span class="name">Server #5 overloaded.  </span>
								<em class="small">4 hrs</em>
								</a>
								</li>
								<li class="new">
								<a href="#">
								<span class="label label-danger"><i class="fa fa-bolt"></i></span>
								<span class="name">Server #31 overloaded.  </span>
								<em class="small">4 hrs</em>
								</a>
								</li>
								<li class="new"><a href="#">See All Notifications</a></li>
								</ul>
								</div>
							</li> -->
							<li>
								<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<img src="public/images/photos/nirjhoranjumsir.png" alt="" />
									<?php echo $_SESSION['SMC_login_admin_name']; ?>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-usermenu pull-right">
									<li><a href="#"><i class="fa fa-user"></i>  Profile</a></li>
									<li><a href="#"><i class="fa fa-cog"></i>  Settings</a></li>
									<li><a href="?exit=yes"><i class="fa fa-sign-out"></i> Log Out</a></li>
								</ul>
							</li>
							
						</ul>
					</div>
					<!--notification menu end -->
					
				</div>
			<!-- header section end-->						