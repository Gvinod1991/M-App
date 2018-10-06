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
                </div>
            </div>
        </div>
       
        <div class="container-fluid">           
		
            <div class="row clearfix">
                <div class="col-12">
                    <h5>Others Details</h5>
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
                                            <td>26-09-2018</td>
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
                                               
                                                <button class="ser-edt btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#serviceEditModal"
                                                data-toggle="tooltip" data-id="" data-name="" data-price="" data-offer="" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>Change Status</a>
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
                                               
                                                <button class="ser-edt btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#serviceEditModal"
                                                data-toggle="tooltip" data-id="" data-name="" data-price="" data-offer="" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>Change Status</a>
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

         //=================================================================================    
         });
 </script>
      
 </body>

 </html>