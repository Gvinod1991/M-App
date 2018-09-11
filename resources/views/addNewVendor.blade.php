 <!doctype html>
<html lang="en">
<head>
<!-- Include Heaer-->
@include('layout.top-header')
</head>
 <body class="theme-green">
 <!-- Preloder-->
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="../images/icon-light.svg" width="48" height="48" alt="HexaBit"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

 <div id="wrapper">
  <!-- Header-->
 @include('layout.header')

 <!-- Left-Side bar-->
 @include('layout.sidebar')

    <div id="main-content">
       
        <div class="container-fluid">
           
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Vendor</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action = "addVendor" method = "post" >
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                               
                                <div class="form-group">
                                    <label>Shop Name</label>
                                    <input type="text" name="shop_name" class="form-control" required>
                                </div>
                                  <div class="form-group">
                                    <label>Owner Name</label>
                                    <input type="text" name="owner_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" required>
                                </div>
								 <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
								 <div class="form-group">
                                    <label>Locality</label>
                                    <input type="text" name="locality" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="addr" rows="3" cols="30" required></textarea>
                                </div>
								 <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="text" name="contact" class="form-control" required>
                                </div>
                              
                             
                              
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
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