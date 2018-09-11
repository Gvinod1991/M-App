 <!doctype html>
<html lang="en">
<head>
<!-- Include Heaer-->
<?php echo $__env->make('layout.top-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
 <body class="theme-green">
 <!-- Preloder-->
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="./assets/images/logo_50.png" width="48" height="48" alt="HexaBit"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

 <div id="wrapper">
  <!-- Header-->
 <?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

 <!-- Left-Side bar-->
 <?php echo $__env->make('layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Main content-->
 <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Dashboard</h2>
                </div>            
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                   
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-8 col-md-12">
                    <div class="card top_summary">
                        <div class="header">
                            <h2>Summary</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4">
                                    <div id="Summary1" class="carousel vert slide" data-ride="carousel" data-interval="1700">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="p-10">
                                                    <h2 class="font700 float-left mr-2">500</h2>
                                                    <small>17% <i class="fa fa-level-up text-success"></i><br>
                                                    Vandors</small>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="p-10">
                                                    <h2 class="font700 float-left mr-2">1000</h2>
                                                    <small>23% <i class="fa fa-level-up text-success"></i><br>
                                                    Custommers </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div id="Summary2" class="carousel vert slide" data-ride="carousel" data-interval="1200">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="p-10">
                                                    <h2 class="font700 float-left mr-2">12000</h2>
                                                    <small>
                                                    Bookings This Month</small>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="p-10">
                                                    <h2 class="font700 float-left mr-2">150000</h2>
                                                    <small>
                                                   Bookings This Year</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div id="Summary3" class="carousel vert slide" data-ride="carousel" data-interval="1000">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="p-10">
                                                    <h2 class="font700 float-left mr-2">432</h2>
                                                    <small>23% <i class="fa fa-level-up text-success"></i><br>
                                                    Total User</small>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="p-10">
                                                    <h2 class="font700 float-left mr-2">56</h2>
                                                    <small>8% <i class="fa fa-level-up text-success"></i><br>
                                                    New User</small>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="p-10">
                                                    <h2 class="font700 float-left mr-2">10K</h2>
                                                    <small>47% <i class="fa fa-level-up text-success"></i><br>
                                                    Pageviews</small>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="p-10">
                                                    <h2 class="font700 float-left mr-2">17K</h2>
                                                    <small>28% <i class="fa fa-level-up text-success"></i><br>
                                                    Visitors</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bline">
                            <h2>Sales Overview</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">                                
                                <li><a class="btn btn-default btn-sm" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">Monthly</a></li>
                                <li><a class="btn btn-outline-primary btn-sm" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Yearly</a></li>
                            </ul>
                        </div>
                        <div class="body">                            
                            <div id="Sales_Overview"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Top Products</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="chart-top-products" class="chartist"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>Money Transactions</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">Booking Transactions</a></li>
                                        <li><a href="javascript:void(0);">Pending Transactions</a></li>
                                        <li><a href="javascript:void(0);">Bank Transactions</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-5">
                                    <div class="sparkline-pie">6,4,8</div>
                                </div>
                                <div class="col-7">
                                   
                                    <span> Booking  <span class="float-right">Rs <b>8,920,000</b></span></span><br>
                                    <span>Pending <span class="float-right">Rs. <b>150,000</b></span></span><br>
                                    <span>Paid <span class="float-right">Rs. <b>120,000</b></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-7">
                                    <h5 class="mb-0">Server</h5>
                                    <small class="info">of 1Tb</small>
                                </div>
                                <div class="col-5 text-right">
                                    <h2 class="m-b-0">62%</h2>
                                </div>
                                <div class="col-12">                                    
                                    <div class="progress progress-sm progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                    <small class="text-small">6% higher than last month</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-7">
                                    <h5 class="mb-0">Email</h5>
                                    <small class="info">of 31</small>
                                </div>
                                <div class="col-5 text-right">
                                    <h2 class="m-b-0">62%</h2>
                                </div>
                                <div class="col-12">                                    
                                    <div class="progress progress-sm progress-transparent custom-color-yellow mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="54"></div>
                                    </div>
                                    <small class="text-small">Total Registered email</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-7">
                                    <h5 class="mb-0">Domians</h5>
                                    <small class="info">of 10</small>
                                </div>
                                <div class="col-5 text-right">
                                    <h2 class="m-b-0">2</h2>
                                </div>
                                <div class="col-12">                                    
                                    <div class="progress progress-sm progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="67"></div>
                                    </div>
                                    <small class="text-small">Total registered Domain</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>

           

        </div>
    </div>

 </div>

 <!-- Javascript -->
 <!-- footer-->
 <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 </body>
 </html>