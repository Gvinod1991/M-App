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
                                            <th>Booking ID</th>
                                            <th>Vendor</th>
                                            <th>Customer Name</th>
                                           
                                            <th>Total Amount</th>
                                             <th>Status</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($bookings){?>
                                       @foreach($bookings as $booking)
                                            <tr>
                                                  <td>{{$booking->id}}</td>
                                                <td>{{$booking->shop_name}}</td>
                                                <td>{{$booking->name}}</td>
                                              
                                                <td>{{$booking->tot_cost}}</td>
                                                <td>
                                                  @if($booking->track_sts =='CANCEL') 
                                                    <span class="badge badge-danger">{{$booking->track_sts}}</span>
                                                     @else
                                                    <span class="badge badge-success">{{$booking->track_sts}}</span>
                                                  @endif
                                                </td>
                                                <td>
                                                <button class="get-book btn btn-sm btn-icon btn-pure btn-default on-default button-remove"data-id="{{$booking->id}}"  data-toggle="modal" data-target="#yesno-day"
                                                data-toggle="tooltip" data-original-title="Remove">View Deatails</a>
                                                </td>
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
 <!-- Small modal -->
                            <div class="modal fade bd-example-modal-lg" id="yesno-day" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
        //======================================================
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
        //======================================================
         });
</script>
 </body>
 </html>