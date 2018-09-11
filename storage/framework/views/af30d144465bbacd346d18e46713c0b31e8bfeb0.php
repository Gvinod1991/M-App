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
                        <a class="navbar-brand" href="javascript:void(0);"><img src="../images/icon-light.svg" width="30" height="30" class="d-inline-block align-top mr-2" alt=""><img height="100" class="img img-responsive" src="./assets/images/logo.png" alt="logo"></a>
                        <ul class="navbar-nav">
                           
                        </ul>
                    </nav>                    
                </div>
                <div class="col-lg-8">
                    <div class="auth_detail">
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>
                        <div class="body">
                        <div class="text-danger">
                        <?php if($errors->any()): ?>
                                <?php echo e(implode('', $errors->all(':message'))); ?>

                        <?php endif; ?>
                        </div>
                                <form class="form-auth-small" method="post" action="<?php echo e(route('login')); ?>">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" class="form-control" id="signin-email" name="email" placeholder="user@domain.com">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" name="password" id="signin-password" placeholder="Password">
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
