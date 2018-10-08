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
                    <h2>Bookings</h2>
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
                                            <th>Vendor</th>
                                            <th>Customer Name</th>
                                            <th>Service Name</th>
                                            <th>Service Date</th>
                                            <th>Time Slot</th>
                                            <th>No of Seats</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($bookings){?>
                                       @foreach($bookings as $booking)
                                            <tr>
                                                <td>{{$booking->shop_name}}</td>
                                                <td>{{$booking->name}}</td>
                                                <td>{{$booking->book_service}}</td>
                                                <td>{{$booking->book_date}}</td>
                                                <td>{{$booking->time_slot}}</td>
                                                <td>{{$booking->no_seat}}</td>
                                                <td>{{$booking->tot_cost}}</td>
                                            </tr>
                                        @endforeach
                                    <?php }else{ ?>
                                        <div class="text-center">No Bookings data available </div>
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