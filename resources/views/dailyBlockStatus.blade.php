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
        <div class="block-header" >
            <div class="row  clearfix text-right">
                         
                <div class="col-md-12 col-sm-12 pull-right" >
                     <a href="{{ url('/vendorProfile/'.$vendor_id) }}" class="btn btn-sm btn-info" title="">View Vendor</a>
                     <a href="{{ url('/viewCallender/'.$vendor_id) }}" class="btn btn-sm btn-primary" title="">Back</a>
                </div>
            </div>
        </div>
       
        <div class="container-fluid">           
		
            <div class="row clearfix">
                <div class="col-12">
                    <?php  $xctp=\Session::get('shop_profile_name');?>
                    <h2>{{$xctp}}</h2>
                    <hr>
                </div>
                <?php
                    $trig = 0;
                ?>
                <div class="col-lg-12 col-md-12">
                    <div class="card pricing3">
                        <div class="body">
                            <div >
                                <i class="icon-support"></i>
                                <h5 class="mt-3">TODAY BLOCK STATUS</h5>
                               
								<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                           <th>DATE</th>
                                           <th>STATUS</th>
											<th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data["dayblock"] as $vendor)
                                        <?php  $rid = 0;?>
                                        <tr>
                                            <td>{{$today}}</td>
                                            <td>
                                           @if($vendor->status ==0) 
                                            <span class="badge badge-success">Open</span>
                                           @else
                                            <span class="badge badge-danger">Closed</span>
                                            <?php  $trig = 1; $rid = $vendor->tabid; ?>
                                           @endif
                                           
                                            </td>
                                         
											<td class="actions">
                                               
                                                <button class="day-block btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#yesno-day"
                                                data-toggle="tooltip" data-id="{{$rid}}" data-vendor="{{$vendor_id}}"  data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>Change Status</a>
                                             </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
               
                @if($trig ==0) 
                 <div class="col-lg-12 col-md-12">
                    <div class="card pricing3">
                        <div class="body">
                            <div >
                                <i class="icon-support"></i>
                                <h5 class="mt-3">SERVICES BLOCK STATUS (Dt: {{$today}})</h5>
                               
								<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        
                                        <tr>
                                           <th>SERVICE NAME</th>
                                           <th>STATUS</th>
											<th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($data["serblock"] as $vendor)
                                        <tr>
                                           
                                            <td>{{$vendor->servname}}</td>
                                            <td>
                                                @if($vendor->status ==0) 
                                                <span class="badge badge-success">Open</span>
                                                @else
                                                <span class="badge badge-danger">Closed</span>
                                               
                                                @endif
                                            </td>
											<td class="actions">
                                               
                                                <button class="ser-block btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#yesno-service"
                                                data-toggle="tooltip" data-tbid="{{$vendor->tabid}}" data-servname="{{$vendor->servname}}" data-servid="{{$vendor->servid}}" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>Change Status</a>
                                             </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                               
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="col-lg-12 col-md-12">
                    <div class="card pricing3">
                        <div class="body">
                            <div >
                                <i class="icon-support"></i>
                                <h5 class="mt-3">TIME-SLOTS BLOCK STATUS (Dt: {{$today}})</h5>
                               
								<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                           <th>TIME SLOT</th>
                                           <th>STATUS</th>
											<th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($data["timeslot"] as $vendor)
                                        <tr>
                                           
                                            <td>{{$vendor->servname}}</td>
                                            <td>
                                                @if($vendor->status ==0) 
                                                <span class="badge badge-success">Open</span>
                                                @else
                                                <span class="badge badge-danger">Closed</span>
                                               
                                                @endif
                                            </td>
											<td class="actions">
                                               
                                                <button class="ser-time btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#yesno-time"
                                                data-toggle="tooltip" data-id="{{$vendor->tabid}}" data-servname="{{$vendor->servname}}" data-servid="{{$vendor->servid}}" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>Change Status</a>
                                             </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card pricing3">
                        <div class="body">
                            <div >
                                <i class="icon-support"></i>
                                <h5 class="mt-3">SEAT BLOCK STATUS (Dt: {{$today}})</h5>
                               
								<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                           <th>TIME SLOT</th>
                                           <th>MAX LIMIT SEAT NO</th>
                                           <th>BLOCKED </th>
										  
                                           <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data["seatbl"] as $vendor)
                                        <tr>
                                            <td>{{$vendor->servname}}</td>
                                            <td>{{$vendor->avl}}</td>
                                            <td>{{$vendor->blk}}</td>
                                            
                                            
											<td class="actions">
                                               
                                                <button class="seat-block btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#yesno-seat"
                                                data-toggle="tooltip" data-id="{{$vendor->tabid}}" data-timeslot="{{$vendor->servname}}" data-slotid="{{$vendor->servid}}" data-avl="{{$vendor->avl}}" data-blk="{{$vendor->blk}}"  data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>Change Status</a>
                                             </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                @else
              
                @endif
            </div>
            
			<div class="row clearfix">
            
          
        </div>
    </div>
	 <!-- larg modal -->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h4" id="myLargeModalLabel">Large modal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Woohoo, you're reading this text in a modal!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Small modal -->
                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h4" id="mySmallModalLabel">Small modal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Woohoo, you're reading this text in a modal!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
	                        <!-- Modal Yes-NO btn -->
                            <div class="modal fade" id="yesno-day" tabindex="-1" role="dialog" aria-labelledby="yesno-day" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="yesno_title">Confirm Box</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="yesno_msg">Are you sure to change the status ?</p>
                                             <input type = "hidden" id = "yesno_day_id" name = "yesno_day_id" value = "{{$rid}}">
                                              <input type = "hidden" id = "yesno_day_vendor" name = "yesno_day_vendor" value = "{{$vendor_id}}">
                                              <input type = "hidden" id = "yesno_day_date" name = "yesno_day_date" value = "{{$today}}">
                                             
                                        </div>
                                         <div id="bankErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="bankSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" id="yesno_day_ok" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <!-- Modal Yes-NO btn -->
                            <div class="modal fade" id="yesno-service" tabindex="-1" role="dialog" aria-labelledby="yesno-service" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="yesno_title">Are you sure to change the status ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <p>Service Name : <span id="ys" style="color:red"></span></p>
                                              <input type = "hidden" id = "yesno_service_id" name = "yesno_service_id" value = "">
                                             <input type = "hidden" id = "yesno_service_tbid" name = "yesno_service_tbid" value = "0">
                                              <input type = "hidden" id = "yesno_service_vendor" name = "yesno_service_vendor" value = "{{$vendor_id}}">
                                              <input type = "hidden" id = "yesno_service_date" name = "yesno_service_date" value = "{{$today}}">
                                             
                                        </div>
                                         <div id="bankErrr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="bankSucc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" id="yesno_service_ok" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <!-- Modal Yes-NO btn -->
                            <div class="modal fade" id="yesno-time" tabindex="-1" role="dialog" aria-labelledby="yesno-time" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="yesno_title">Are you sure to change the status ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <p>Service Name : <span id="ystime" style="color:red"></span></p>
                                              <input type = "hidden" id = "yesno_time_id" name = "yesno_time_id" value = "">
                                             <input type = "hidden" id = "yesno_time_tbid" name = "yesno_time_tbid" value = "0">
                                              <input type = "hidden" id = "yesno_time_vendor" name = "yesno_time_vendor" value = "{{$vendor_id}}">
                                              <input type = "hidden" id = "yesno_time_date" name = "yesno_time_date" value = "{{$today}}">
                                             
                                        </div>
                                         <div id="timeErrr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="timeSucc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" id="yesno_time_ok" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="yesno-seat" tabindex="-1" role="dialog" aria-labelledby="yesno-seat" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="yesno_title">Seat Block Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <p>Time Slot : <span id="dptime" style="color:red"></span></p>
                                            <p>no of block seat :  <input type = "number" id = "yesno_seat_blk" name = "yesno_time_id" value = ""></p>
                                           
                                              <input type = "hidden" id = "yesno_seat_avl" name = "yesno_seat_id" value = "">
                                               <input type = "hidden" id = "yesno_slot_id" name = "yesno_seat_id" value = "">
                                             <input type = "hidden" id = "yesno_seat_tbid" name = "yesno_seat_tbid" value = "0">
                                              <input type = "hidden" id = "yesno_seat_vendor" name = "yesno_seat_vendor" value = "{{$vendor_id}}">
                                              <input type = "hidden" id = "yesno_seat_date" name = "yesno_seat_date" value = "{{$today}}">
                                             
                                        </div>
                                         <div id="seatErrr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="seatSucc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="yesno_seat_ok" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                           
                           
                           
    
</div>
    
</div>
 <!-- Javascript -->
 <!-- footer-->
 @include ('layout.footer')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
      </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script>
         jQuery(document).ready(function(){
         //=================================================================================
       
                 //Update Bank Details =========================
            jQuery('#yesno_day_ok').click(function(e){
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
                  url: "{{ url('/dayBlockchangeStatus') }}",
                  method: 'post',
                  data: 
                  {
                     bid: jQuery('#yesno_day_id').val(),
                     bdate: jQuery('#yesno_day_date').val(),
                     vid: jQuery('#yesno_day_vendor').val()
                
                  },
                  success: function(result)
                  {
                        var pk = result.success;
                    
                        if(result.status==1)
                        {
                                jQuery('#bankSuc').show();
                                jQuery('#bankSuc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 3000);
                        }
                        else if(result.status==0)
                        {
                                jQuery('#bankErr').show();
                                jQuery('#bankErr').html(pk[Object.keys(pk)[0]]);
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
              jQuery('.ser-block').click(function(e){
                  
                   var tbid = $(this).data("tbid") ;
                   var servid = $(this).data("servid");
                   var serv_name = $(this).data("servname");

                   jQuery('#yesno_service_tbid').val(tbid);
                   jQuery('#yesno_service_id').val(servid);
                   jQuery('#ys').text(serv_name);

              });

              //=====================================================================================
               //Update Bank Details =========================
            jQuery('#yesno_service_ok').click(function(e){
                    jQuery('#bankErrr').hide();
                    jQuery('#bankSucc').hide();
                    e.preventDefault();
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('/serviceBlockchangeStatus') }}",
                  method: 'post',
                  data: 
                  {
                     bid: jQuery('#yesno_service_tbid').val(),
                     bdate: jQuery('#yesno_service_date').val(),
                     vid: jQuery('#yesno_service_vendor').val(),
                     sid: jQuery('#yesno_service_id').val()
                
                  },
                  success: function(result)
                  {
                        var pk = result.success;
                    
                        if(result.status==1)
                        {
                                jQuery('#bankSucc').show();
                                jQuery('#bankSucc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 3000);
                        }
                        else if(result.status==0)
                        {
                                jQuery('#bankErrr').show();
                                jQuery('#bankErrr').html(pk[Object.keys(pk)[0]]);
                        }
                        else
                        {
                                jQuery('#bankErrr').show();
                                jQuery('#bankErrr').html(result.success);
                        }
                    
                  }
                });
                  
             });

               //=============================================================================
              jQuery('.ser-time').click(function(e){
                  
                   var tbid = $(this).data("id") ;
                   var servid = $(this).data("servid");
                   var serv_name = $(this).data("servname");

                   jQuery('#yesno_time_tbid').val(tbid);
                   jQuery('#yesno_time_id').val(servid);
                   jQuery('#ystime').text(serv_name);

              });

              //================================================================================
               //Update Bank Details =========================
            jQuery('#yesno_time_ok').click(function(e){
                    jQuery('#timeErrr').hide();
                    jQuery('#timeSucc').hide();
                    e.preventDefault();
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('/timeBlockchangeStatus') }}",
                  method: 'post',
                  data: 
                  {
                     bid: jQuery('#yesno_time_tbid').val(),
                     bdate: jQuery('#yesno_time_date').val(),
                     vid: jQuery('#yesno_time_vendor').val(),
                     sid: jQuery('#yesno_time_id').val()
                
                  },
                  success: function(result)
                  {
                        var pk = result.success;
                    
                        if(result.status==1)
                        {
                                jQuery('#timeSucc').show();
                                jQuery('#timeSucc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 3000);
                        }
                        else if(result.status==0)
                        {
                                jQuery('#timeErrr').show();
                                jQuery('#timeErrr').html(pk[Object.keys(pk)[0]]);
                        }
                        else
                        {
                                jQuery('#timeErrr').show();
                                jQuery('#timeErrr').html(result.success);
                        }
                    
                  }
                });
                  
             });

        //=================================================================================
          //=============================================================================
              jQuery('.seat-block').click(function(e){
                  
                   var tbid = $(this).data("id") ;
                   var slotid = $(this).data("slotid");
                    var slot_name = $(this).data("timeslot");
                   var slot_blk = $(this).data("blk");
                   var slot_avl = $(this).data("avl");

                   jQuery('#yesno_seat_tbid').val(tbid);
                   jQuery('#yesno_slot_id').val(slotid);
                   jQuery('#yesno_seat_blk').val(slot_blk);
                   jQuery('#yesno_seat_avl').val(slot_avl);
                   jQuery('#dptime').text(slot_name);


              });

         //=================================================================================    
         //Update Bank Details =========================
            jQuery('#yesno_seat_ok').click(function(e){
                    jQuery('#seatErrr').hide();
                    jQuery('#seatSucc').hide();
                    e.preventDefault();
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('/seatBlockchangeStatus') }}",
                  method: 'post',
                  data: 
                  {
                     bid: jQuery('#yesno_seat_tbid').val(),
                     bdate: jQuery('#yesno_seat_date').val(),
                     vid: jQuery('#yesno_seat_vendor').val(),
                     sid: jQuery('#yesno_slot_id').val(),
                     blk: jQuery('#yesno_seat_blk').val(),
                     avl: jQuery('#yesno_seat_avl').val()
                
                  },
                  success: function(result)
                  {
                        var pk = result.success;
                    
                        if(result.status==1)
                        {
                                jQuery('#seatSucc').show();
                                jQuery('#seatSucc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 3000);
                        }
                        else if(result.status==0)
                        {
                                jQuery('#seatErrr').show();
                                jQuery('#seatErrr').html(pk[Object.keys(pk)[0]]);
                        }
                        else
                        {
                                jQuery('#seatErrr').show();
                                jQuery('#seatErrr').html(result.success);
                        }
                    
                  }
                });
                  
             });

        //=================================================================================
         });
 </script>
      
 </body>

 </html>