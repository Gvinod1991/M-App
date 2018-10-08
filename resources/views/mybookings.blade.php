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
                <div class="col-md-12 col-sm-12">
                 <?php  $xctp=\Session::get('shop_profile_name');$xcid=\Session::get('shop_profile_id');?>
                    <h2>{{$xctp}}</h2>
                </div>   
                     
                <div class="col-md-12 col-sm-12 text-right" >
                       <a href="{{ url('/vendorProfile/'.$xcid) }}" class="btn btn-sm btn-info" title="">View Vendor</a>
                    <a href="{{ url('/viewCallender/'.$xcid) }}" class="btn btn-sm btn-primary" title="">Block Callender</a>
                     <a href="{{ url('/mybookings/'.$xcid) }}" class="btn btn-sm btn-primary" title="">My Bookings</a>
                   
                </div>
            </div>
        </div>
        
        <?php  $today = date("Y-m-d"); ?>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                           
                            <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Bookings</h2>
                        </div>
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-withicon"><i class="fa fa-home"></i> Today's Bookings</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-withicon"><i class="fa fa-user"></i> Advance Bookings</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Contact-withicon"><i class="fa fa-vcard"></i> Bookings History</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="Home-withicon">
                                   
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Service Name</th>
                                                <th>Time Slot</th>
                                                <th>No of Seats</th>
                                                <th>Customer Name</th>
                                                <th>Customer Mobile</th>
                                                <th>Total Amount</th>
                                                 <th>STATUS</th>
                                            
                                            </tr>
                                        </thead>
                                          <tbody>
                                        <?php if($bookings){?>
                                       @foreach($bookings as $booking)
                                            @if($today==$booking->book_date) 
                                            <tr>
                                                <td>{{$booking->book_date}}</td>
                                                <td>{{$booking->book_service}}</td>
                                                <td>{{$booking->time_slot}}</td>
                                                <td>{{$booking->no_seat}}</td>
                                                <td>{{$booking->name}}</td>
                                                <td>{{$booking->mobile}}</td>
                                                <td>{{$booking->tot_cost}}</td>
                                                <td>
                                                  @if($booking->track_sts =='CANCEL') 
                                                    <span class="badge badge-danger">$booking->track_sts</span>
                                                     @else
                                                    <span class="badge badge-success">$booking->track_sts</span>
                                                  @endif
                                                </td>
                                            </tr>
                                             @endif
                                        @endforeach
                                    <?php }else{ ?>
                                        <div class="text-center">No Bookings data available </div>
                                     <?php } ?>
                                       </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="Profile-withicon">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Service Name</th>
                                                <th>Time Slot</th>
                                                <th>No of Seats</th>
                                                <th>Customer Name</th>
                                                <th>Customer Mobile</th>
                                                <th>Total Amount</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    
                                                <?php if($bookings){?>
                                       @foreach($bookings as $booking)
                                            @if($today < $booking->book_date) 
                                            <tr>
                                                <td>{{$booking->book_date}}</td>
                                                <td>{{$booking->book_service}}</td>
                                                <td>{{$booking->time_slot}}</td>
                                                <td>{{$booking->no_seat}}</td>
                                                <td>{{$booking->name}}</td>
                                                <td>{{$booking->mobile}}</td>
                                                <td>{{$booking->tot_cost}}</td>
                                                <td>
                                                  @if($booking->track_sts =='CANCEL') 
                                                    <span class="badge badge-danger">$booking->track_sts</span>
                                                     @else
                                                    <span class="badge badge-success">$booking->track_sts</span>
                                                  @endif
                                                </td>
                                            </tr>
                                             @endif
                                        @endforeach
                                    <?php }else{ ?>
                                        <div class="text-center">No Bookings data available </div>
                                     <?php } ?>
                                        
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="Contact-withicon">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Service Name</th>
                                                <th>Time Slot</th>
                                                <th>No of Seats</th>
                                                <th>Customer Name</th>
                                                <th>Customer Mobile</th>
                                                <th>Total Amount</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                     <?php if($bookings){?>
                                       @foreach($bookings as $booking)
                                            @if($today > $booking->book_date) 
                                            <tr>
                                                <td>{{$booking->book_date}}</td>
                                                <td>{{$booking->book_service}}</td>
                                                <td>{{$booking->time_slot}}</td>
                                                <td>{{$booking->no_seat}}</td>
                                                <td>{{$booking->name}}</td>
                                                <td>{{$booking->mobile}}</td>
                                                <td>{{$booking->tot_cost}}</td>
                                                <td>
                                                  @if($booking->track_sts =='CANCEL') 
                                                    <span class="badge badge-danger">{{$booking->track_sts}}</span>
                                                     @else
                                                    <span class="badge badge-success">{{$booking->track_sts}}</span>
                                                  @endif
                                                </td>
                                            </tr>
                                             @endif
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
                    </div>
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
 
<script>
 
</script>
 
    

 </body>
 </html>