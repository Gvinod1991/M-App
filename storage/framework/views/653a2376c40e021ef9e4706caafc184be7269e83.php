<!doctype html>
<html lang="en">

<head>
<!-- Include Heaer-->
<?php echo $__env->make('layout.top-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>

<body class="theme-green auth-main">
    
    <!-- WRAPPER -->
	<div id="wrapper">
        <div class="container">
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="javascript:void(0);"><img src="../images/icon-light.svg" width="30" height="30" class="d-inline-block align-top mr-2" alt="">MyStyle</a>
                        <ul class="navbar-nav">
                           
                        </ul>
                    </nav>                    
                </div>
                <div class="col-lg-8">
                    <div class="auth_detail">
                        <h2 class="text-monospace">
                            Everything<br> you need for
                            <div id="carouselExampleControls" class="carousel vert slide" data-ride="carousel" data-interval="1500">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">your Admin</div>
                                    <div class="carousel-item">your Project</div>
                                    <div class="carousel-item">your Dashboard</div>
                                    <div class="carousel-item">your Application</div>
                                    <div class="carousel-item">your Client</div>
                                </div>
                            </div>
                        </h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                        <ul class="social-links list-unstyled">
                            <li><a class="btn btn-default" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="btn btn-default" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="btn btn-default" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="instagram"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" method="post" action="http://localhost/my-style-app/login">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" class="form-control" id="signin-email" name="email" value="user@domain.com" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" name="password" id="signin-password" value="thisisthepassword" placeholder="Password">
                                </div>
                               <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                             
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <!-- END WRAPPER -->
    
<!-- footer-->
 <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
