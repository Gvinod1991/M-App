 <div id="left-sidebar" class="sidebar">
        <div class="navbar-brand">
            <a href="{{ url('/index') }}"><img src="{{URL::to('/')}}/assets/images/logo_50.png" alt="HexaBit Logo" class="img-fluid logo"><span>MyStyle</span></a>
            <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right"><i class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
        </div>
        <div class="sidebar-scroll">
            <div class="user-account">
                <div class="user_div">
                    <img src="{{URL::to('/')}}/public/uploads/profile.png" class="user-photo" alt="User Profile Picture">
                </div>
                <div class="dropdown">
                    <span>Welcome,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ Auth::user()->name }}</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <!--<li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                        <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>-->
                        <li><a href="{{route('settings')}}"><i class="icon-settings"></i>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('logout')}}"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
            </div>  
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                <?php  $xtp=\Session::get('user_type');?>
                 @if($xtp==0) 
                    <li><a href="{{ url('/index') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>
                    <li><a href="{{route('vendors')}}"><i class="icon-users"></i><span>Vendors</span></a></li>
                    <li><a href="{{route('customers')}}"><i class="icon-user"></i><span>Custommers</span></a></li>
                    <li><a href="{{route('bookings')}}"><i class="icon-calendar"></i><span>Bookings</span></a></li>
                    <li><a href="{{route('coupons')}}"><i class="icon-tag"></i><span>Coupons</span></a></li>
                @endif
                </ul>
            </nav>     
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
    </script>
    <Script>
    jQuery(function($) {
     var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
     $('#main-menu li a').each(function() {
         console.log(this.href);
         console.log(path);
      if (this.href === path) {
       $(this).parent().addClass('active');
      }
     });
    });
   </script>