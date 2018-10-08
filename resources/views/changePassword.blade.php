<!doctype html>
<html lang="en">
<head>
<!-- Include Heaer-->
@include('layout.top-header')
</head>
 <body class="theme-green">
 <!-- Preloder-->
<!-- Page Loader -->
@include('layout.preloader')
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

 <div id="wrapper">
  <!-- Header-->
 @include('layout.header')

 <!-- Left-Side bar-->
 @include('layout.sidebar')

<!-- Main content-->
 <div id="main-content">
           
 <div class="container-fluid">
           
           <div class="row clearfix">
               <div class="col-md-12">
                   <div class="card">
                       <div class="header">
                           <h2>Update Password</h2> 
                       </div>
                       <div class="body">
                        <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            @if(Session::has('flash_message'))
                            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>{{ Session::get('flash_message') }}</div>
                            @elseif(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>{{ Session::get('error_message') }}</div>
                            @endif 
                           <form id="basic-form" action = "{{route('settings')}}" method = "post" >
                               <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                              
                               <div class="form-group">
                                   <label>Password</label>
                                   <input type="password" name="password" class="form-control" required>
                               </div>
                               <div class="form-group">
                                   <label>Confirm Password</label>
                                   <input type="password" class="form-control" name="confirm-password" required />
                               </div>
                               <button type="submit" class="btn btn-primary">Submit</button>
                           </form>
                        </div>
                        <div class="col-md-4"></div>
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
 @include ('layout.footer')
 </body>
 </html>