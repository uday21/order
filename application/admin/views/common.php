<?php
if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) {

} else {
    header('location:../welcome/login');
} ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Order Food Now</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo  base_url('assets/bootstrap/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo  base_url('assets/dist/css/AdminLTE.min.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo  base_url('assets/dist/css/skins/_all-skins.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url('assets/dist/css/stylesheet.css');?>">
    <link href="<?php echo base_url('assets/css/jquery.validation.css');?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?php echo  base_url('assets/dist/js/jquery-1.10.2.min.js');?>"></script>
    <script src="<?php echo  base_url('assets/bootstrap/js/bootstrap.js');?>"></script>
    <script src="<?php echo  base_url('assets/dist/js/app.js');?>"></script>
    <script src="<?php echo  base_url('assets/dist/js/demo.js');?>"></script>
    <script src="<?php echo  base_url('assets/dist/js/jquery.validate.js');?>"></script>
    <script src="<?php echo  base_url('assets/dist/js/additional-methods.js');?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {

    		checkorders();

			setInterval(function() {
				checkorders();
			}, 5000);

			function checkorders() {
				 $.ajax({
						type: 'get',
						url: 'http://order.orderfoodnow.in/api/index.php/api/orderadmincount',
						data: {
						},
						beforeSend: function() {},
						success: function(data) {
							$('.orderlist').text(data);
						}
					});
			}
			
            $(function() {
                var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
                $("#sidebar_active ul li a").each(function(){
                    if($(this).attr("href") == pgurl || $(this).attr("href") == '' ){
                        $(this).parent().parent().parent().addClass("active");
                    }
                })
           });
        });


    </script>



</head>

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<header class="main-header">
    <!-- Logo -->
    <a href="dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Order Food</b> NOW</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="orders" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning orderlist">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="orders">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url('assets/dist/img/avatar5.png'); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs">Admin</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url('assets/dist/img/avatar5.png'); ?>" class="img-circle" alt="User Image">
                            <p>
                                Admin
                            </p>

                        </li>



                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="../welcome/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>

<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" id="sidebar_active">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo  base_url('assets/dist/img/avatar5.png');?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="notifications"><i class="fa fa-cloud"></i> <span>Notifications</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i> <span>Restaurant</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="restaurant"><i class="fa fa-circle-o"></i>Restaurant</a></li>
                    <li><a href="branch"><i class="fa fa-circle-o"></i>Branch</a></li>
                   <!-- <li><a href="add_users"><i class="fa fa-circle-o"></i>Add Users</a></li>-->
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-spoon"></i> <span>Menus</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="category"><i class="fa fa-circle-o"></i>Category</a></li>
                    <li><a href="menus"><i class="fa fa-circle-o"></i>Menus</a></li>
                    <li><a href="add_image"><i class="fa fa-circle-o"></i>Food Images</a></li>
<!--                    <li><a href="add_menugroup"><i class="fa fa-circle-o"></i>Menu Group</a></li>-->
                    <li><a href="ingredientgroup"><i class="fa fa-circle-o"></i>Ingredient Group</a></li>
                    <li><a href="ingredient"><i class="fa fa-circle-o"></i>Ingredient</a></li>
                </ul>
            </li>
            <li><a href="offers"><i class="fa  fa-ticket"></i> <span>Offers</span></a></li>
            <li>
                <a href="orders?id=0">
                    <i class="fa fa-files-o"></i>
                    <span>Orders</span>
                    <span class="label label-primary pull-right orderlist">0</span>
                </a>

            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-map-marker"></i> <span>Location</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="city"><i class="fa fa-circle-o"></i>City</a></li>
                    <li><a href="area"><i class="fa fa-circle-o"></i>Area</a></li>
                </ul>
            </li>
            <li><a href="delivery_charge"><i class="fa fa-rupee"></i> <span>Delivery Charges</span></a></li>
            <li><a href="#"><i class="fa fa-user"></i> <span>Customer Details</span></a></li>
            <li><a href="registered_users"><i class="fa fa-user-md"></i> <span>Registered Users</span></a></li>
            <li><a href="user_credentials"><i class="fa fa-users"></i> <span>User Credentials</span></a></li>
            <li><a href="allocate_hotels"><i class="fa  fa-user-plus"></i> <span>Allocate Hotels</span></a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
