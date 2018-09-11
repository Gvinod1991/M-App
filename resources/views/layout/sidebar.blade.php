 <div id="left-sidebar" class="sidebar">
        <div class="navbar-brand">
            <a href="index.html"><img src="{{ asset('/assets/images/logo.png')}}" alt="HexaBit Logo" class="img-fluid logo"></a>
            <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right"><i class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
        </div>
        <div class="sidebar-scroll">
            <div class="user-account">
                <div class="user_div">
                    <img src="{{ asset('assets/images/user.png') }}" class="user-photo" alt="User Profile Picture">
                </div>
                <div class="dropdown">
                    <span>Welcome,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>Shankar Bag</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="{{ route('profile') }}"><i class="icon-user"></i>My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
            </div>  
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="active"><a href="index"><i class="icon-home"></i><span>Dashboard</span></a></li>
                    <li><a href="{{ route('viewVendor') }}"><i class="icon-envelope"></i><span>Vandor List</span></a></li>
                    <li><a href="{{ route('customerList') }}" ><i class="icon-bubbles"></i><span>Custommer List</span></a></li>
                    <li>
                        <a href="index.html#uiElements" class="has-arrow"><i class="icon-diamond"></i><span>Booking Report</span></a>
                        <ul>
                            <li><a href="{{ route('bookings') }}">Confirm Booking</a></li>
                            <li><a href="{{ route('pending-bookings') }}">Pending List</a></li>
                           
                        </ul>
                    </li>
                
                </ul>
            </nav>     
        </div>
    </div>

   