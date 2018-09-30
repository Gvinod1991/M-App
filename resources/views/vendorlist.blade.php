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
                    <h2>Vendor List</h2>
                </div>            
                <div class="col-md-6 col-sm-12 text-right">
                   
                    <a href="{{route('newVendor')}}"  class="btn btn-sm btn-primary" title="">Add New</a>
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
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Contact Info</th>
                                            <th>Email</th>
                                            <th>Status</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>Name</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Contact Info</th>
                                            <th>Email</th>
                                            <th>Status</th>
											<th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       @foreach($vendors as $vendor)
                                                <tr>
                                                    <td>{{$vendor->shop_name}}</td>
                                                    <td>{{$vendor->addr}}</td>
                                                    <td>{{$vendor->city}}</td>
                                                    <td>{{$vendor->contact}}</td>
                                                    <td>{{$vendor->email}}</td>
                                                    <td>{{$vendor->sts}}</td>
                                                    <td class="actions">
                                               
											           <a href="vendorProfile/{{$vendor->id}}" class="has-arrow"><i class="icon-eye"></i><span>View</span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                      
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