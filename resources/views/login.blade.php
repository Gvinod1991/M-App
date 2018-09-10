<!doctype html>
<html lang="en">

<head>
<!-- Include Heaer-->
@include('layout.top-header')
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
                        @if ($errors->any())
                                {{ implode('', $errors->all(':message')) }}
                        @endif
                        </div>
                                <form class="form-auth-small" method="post" action="{{ route('login') }}">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" class="form-control" id="signin-email" name="email" placeholder="user@domain.com">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" name="password" id="signin-password" placeholder="Password">
                                </div>
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
 @include ('layout.footer')
</body>
</html>
