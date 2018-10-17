 <!doctype html>
<html lang="en">
<head>
<!-- Include Heaer-->
@include('layout.top-header')
<meta name="_token" content="{{csrf_token()}}" />
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
                 <?php  $xctp=\Session::get('shop_profile_name');$xcid=\Session::get('shop_profile_id'); $xtp=\Session::get('user_type'); ?>
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
                                                <th>Booking ID</th>
                                              
                                                <th>Customer Name</th>
                                                 @if($xtp==0) 
                                                <th>Customer Mobile</th>
                                                <th>Total Amount</th>
                                                @endif
                                                 <th>STATUS</th>
                                            
                                            </tr>
                                        </thead>
                                          <tbody>
                                        <?php if($bookings){?>
                                       @foreach($bookings as $booking)
                                           @if($today==$booking->book_date) 
                                            <tr>
                                                <td>{{$booking->book_date}}</td>
                                                <td>{{$booking->id}}</td>
                                               
                                                <td>{{$booking->name}}</td>
                                                 @if($xtp==0) 
                                                <td>{{$booking->mobile}}</td>
                                                <td>{{$booking->tot_cost}}</td>
                                                @endif
                                                <td>
                                                    @if($booking->track_sts =='CANCEL') 
                                                    <span class="badge badge-danger">{{$booking->track_sts}}</span>
                                                    @elseif($booking->track_sts =='ACTIVE') 
                                                    <span class="badge badge-primary">{{$booking->track_sts}}</span>
                                                    <button class="con-code btn btn-sm btn-icon btn-pure btn-default on-default button-remove"data-id="{{$booking->id}}"  data-toggle="modal" data-target="#yesno-day"
                                                data-toggle="tooltip" data-original-title="Remove">Confirm Now</a>
                                                    @else
                                                    <span class="badge badge-success">{{$booking->track_sts}}</span>
                                                  @endif
                                                </td>
                                                <td>
                                                <button class="get-book btn btn-sm btn-icon btn-pure btn-default on-default button-remove"data-id="{{$booking->id}}"  data-toggle="modal" data-target="#book-detl"
                                                data-toggle="tooltip" data-original-title="Remove">View Deatails</a>
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
                                                <th>Booking ID</th>
                                              
                                                <th>Customer Name</th>
                                                 @if($xtp==0) 
                                                <th>Customer Mobile</th>
                                                <th>Total Amount</th>
                                                @endif
                                                 <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    
                                                <?php if($bookings){?>
                                       @foreach($bookings as $booking)
                                            @if($today < $booking->book_date) 
                                            <tr>
                                                <td>{{$booking->book_date}}</td>
                                                <td>{{$booking->book_id}}</td>
                                              
                                                <td>{{$booking->name}}</td>
                                                 @if($xtp==0) 
                                                <td>{{$booking->mobile}}</td>
                                                <td>{{$booking->tot_cost}}</td>
                                                @endif
                                                <td>
                                                  @if($booking->track_sts =='CANCEL') 
                                                    <span class="badge badge-danger">{{$booking->track_sts}}</span>
                                                     @else
                                                    <span class="badge badge-success">{{$booking->track_sts}}</span>
                                                  @endif
                                                </td>
                                                 <td>
                                                <button class="get-book btn btn-sm btn-icon btn-pure btn-default on-default button-remove"data-id="{{$booking->id}}"  data-toggle="modal" data-target="#book-detl"
                                                data-toggle="tooltip" data-original-title="Remove">View Deatails</a>
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
                                                <th>Booking ID</th>
                                               
                                                <th>Customer Name</th>
                                                 @if($xtp==0) 
                                                <th>Customer Mobile</th>
                                                <th>Total Amount</th>
                                                @endif
                                                 <th>STATUS</th>
                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                     <?php if($bookings){?>
                                       @foreach($bookings as $booking)
                                            @if($today > $booking->book_date) 
                                           <tr>
                                                <td>{{$booking->book_date}}</td>
                                                <td>{{$booking->id}}</td>
                                                
                                                <td>{{$booking->name}}</td>
                                                 @if($xtp==0) 
                                                <td>{{$booking->mobile}}</td>
                                                <td>{{$booking->tot_cost}}</td>
                                                @endif
                                                <td>
                                                  @if($booking->track_sts =='CANCEL') 
                                                    <span class="badge badge-danger">{{$booking->track_sts}}</span>
                                                     @else
                                                    <span class="badge badge-success">{{$booking->track_sts}}</span>
                                                  @endif
                                                </td>
                                                 <td>
                                                <button class="get-book btn btn-sm btn-icon btn-pure btn-default on-default button-remove"data-id="{{$booking->id}}"  data-toggle="modal" data-target="#book-detl"
                                                data-toggle="tooltip" data-original-title="Remove">View Deatails</a>
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
 <!-- Small modal -->
                            <div class="modal fade bd-example-modal-sm" id="yesno-day" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h4" id="mySmallModalLabel">Enter Confirm Code</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                           <input type = "number" class="form-control" id = "booking_code" name = "booking_code" value = "">
                                            <input type = "hidden" class="form-control" id = "booking_refid" name = "booking_refid" value = "">
                                        </div>
                                        <div id="bankErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="bankSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                           
                                            <button type="button" id="yesno_seat_ok" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="modal fade bd-example-modal-lg" id="book-detl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h4" id="mySmallModalLabel">Booking Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" >
                                             <div class="table-responsive">
                                        <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                            <thead>
                                                <tr>
                                                    <th>Service Name</th>
                                                    <th>Time Slot</th>
                                                    <th>No Seat</th>
                                                    <th>Price</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody id="all-booking">
                                        
                                            </tbody>
                                        </table>
                                        </div>


                                             </div>
                                       
                                        <div class="modal-footer">
                                           
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
 <!-- Javascript -->
 <!-- footer-->
 @include ('layout.footer')
 
<script>
         jQuery(document).ready(function(){
             //Service New Add Part =========================
              jQuery('.con-code').click(function(e){

                  var bkid = $(this).data("id") ;
                  jQuery('#booking_refid').val(bkid);
               
            });
            //================================================================
             jQuery('.get-book').click(function(e){
                 
                    e.preventDefault();
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('/getMybookingDetails') }}",
                  method: 'post',
                  data: 
                  {
                     id: $(this).data("id")
                   
                  },
                  success: function(result)
                  {
                        
                         jQuery('#all-booking').html(result.success);
                  }
                });
                  
             });
            //=====================================================================
              jQuery('#yesno_seat_ok').click(function(e){
                    jQuery('#bankErr').hide();
                    jQuery('#bankSuc').hide();
                    e.preventDefault();
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('/confirmCode') }}",
                  method: 'post',
                  data: 
                  {
                     id: jQuery('#booking_refid').val(),
                     code: jQuery('#booking_code').val()
                   
                  },
                  success: function(result)
                  {
                        //alert(result.status);
                        if(result.status==1)
                        {
                                jQuery('#bankSuc').show();
                                jQuery('#bankSuc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 2000);
                        }
                       
                        else
                        {
                                jQuery('#bankErr').show();
                                jQuery('#bankErr').html(result.success);
                        }
                    
                  }
                });
                  
             });
              //=============================================================================
         });
</script>
 
    

 </body>
 </html>