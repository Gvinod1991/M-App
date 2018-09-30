<!doctype html>
<html lang="en">
<head>
<!-- Include Heaer-->
@include('layout.top-header')
</head>
 <body class="theme-green">
 <!-- Preloder-->
<!-- Page Loader -->
@include('layout.preloder')
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

 <div id="wrapper">
  <!-- Header-->
 @include('layout.header')

 <!-- Left-Side bar-->
 @include('layout.sidebar')

     <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Customer List</h2>
                </div>            
                
            </div>
        </div>
        <div class="container-fluid">
            
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email ID</th>
                                            <th>Mobile No</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($users){?>
                                       @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email_id}}</td>
                                                    <td>{{$user->mobile}}</td>
                                                    <td>{{$user->location}}</td>
                                                </tr>
                                            @endforeach
                                    <?php }else{ ?>
                                    <div class="text-center">No customers data available!</div>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="row clearfix">
            </div>

        </div>
    </div>
    
</div>
 <!-- Javascript -->
 <!-- footer-->
 @include ('layout.footer')
 </body>
 </html>