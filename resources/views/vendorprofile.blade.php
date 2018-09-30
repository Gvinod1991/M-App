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
    @foreach($data["vendors"] as $vendor)
                  <?php $sts = $vendor->sts;$vid =$vendor->id;$imgb = $vendor->photo;$shop_name = $vendor->shop_name;
                  
                   ?>
                @endforeach
     <div id="main-content">
        <div class="block-header" >
            <div class="row  clearfix text-right" >
                         
                <div class="col-md-12 col-sm-12 " >
                     <a href="{{ url('/vendorProfile/'.$vid) }}" class="btn btn-sm btn-info" title="">View Vendor</a>
                    <a href="{{ url('/viewCallender/'.$vid) }}" class="btn btn-sm btn-primary" title="">Block Callender</a>
                   
                </div>
            </div>
        </div>
       
        <div class="container-fluid">           
			<div class="row clearfix">
                <div class="col-12">
              
                    <h5>Vendor Profile</h5>
                    <div style="margin-top:-30px"class="pull-right">
                    <a href="{{route('vendors')}}"  class="btn btn-sm btn-primary" title=""><i class="icon-list"></i> Vendors list</a>
                    {!! link_to_route('editVendor', 'Edit', [$vendor->id],['class'=>'btn btn-info','onclick'=>"javascript:return confirm('Are you sure want to edit?')"])  !!}
                    </div>
                    <hr>
                    
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card pricing2">
                        <div class="body">
                            <div class="pricing-plan">
                            
                                <img src="{{ url('public/uploads/vendors/'.$imgb) }}" alt="" class="pricing-img">
                                <h2 class="pricing-header">{{$shop_name}}</h2>
									
                               <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="" >
                                 <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                 <input type="hidden" name="vid" value="{{ $vid}}">
                                 <input type="file" name="logo" class="form-control" id="catagry_logo"><br>
                                  <button type="button" id="upimg" class="btn btn-outline-primary">Upload</button>
                               </form>
                                
                              </div>
                              
                        </div>
                        
                    </div>
                      
                    <h5>Status : 
                     @if($sts =='Active') 
                    <span class="badge badge-success">{{$sts}}</span>    <a href="#" data-id="{{$vid}}" data-status="{{$sts}}" data-toggle="modal" data-target="#yesno" class="btn act btn-sm btn-primary" title="">De-Active</a>
                    @else
                    <span class="badge badge-danger">{{$sts}}</span>    <a href="#" data-id="{{$vendor->id}}" data-status="{{$vendor->is_enable}}" data-toggle="modal" data-target="#yesno" class="btn act btn-sm btn-primary" title="">Active</a>
                    @endif
                    </h5>
                </div>
                <div class="col-lg-8 col-md-12">
                     @foreach($data["vendors"] as $vendor)
                    
                     <div class="body">
							<small class="text-muted">Shop Name: </small>
                            <p>{{$vendor->shop_name}}</p>
							<hr>
                             <small class="text-muted">Owner Name: </small>
                            <p>{{$vendor->owner_name}}</p>
                             <hr>
							  <small class="text-muted">Email address: </small>
                            <p>{{$vendor->email}}</p> 
							<hr>
							  <small class="text-muted">Mobile: </small>
                            <p>{{$vendor->contact}}</p>
                            <hr>
                            <small class="text-muted">State: </small>
                            <p>{{$vendor->state}}</p>
                            
                            <hr>
                            <small class="text-muted">City: </small>
                            <p>{{$vendor->city}}</p>
                             <hr>
                            <small class="text-muted">Locality: </small>
                            <p>{{$vendor->locality}}</p>                         
                            <hr>
                            <small class="text-muted">Address: </small>
                            <p>{{$vendor->addr}}</p>                         
                            <hr>
                          
                            <small class="text-muted">Shop Opening Time: </small>
                            <p class="m-b-0">{{$vendor->open_at}}</p>
							 <hr>
                          
                            <small class="text-muted">Shop Closing Time: </small>
                            <p class="m-b-0">{{$vendor->close_at}}</p>
                            <hr>
                            <small class="text-muted">Social: </small>
                            <p><i class="fa fa-twitter m-r-5"></i> {{$vendor->twiter_link}}</p>
                            <p><i class="fa fa-facebook  m-r-5"></i> {{$vendor->facebook_link}}</p>
                            <p><i class="fa fa-youtube m-r-5"></i> {{$vendor->youtube_link}}</p>
                            <p><i class="fa fa-instagram m-r-5"></i> {{$vendor->instagram_link}}</p>
                             @endforeach
							<hr>
							
							<hr>
                        </div>
					
                </div>
              
            </div>
           
            

            <div class="row clearfix">
                <div class="col-12">
                    <h5>Others Details</h5>
                    <hr>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card pricing3">
                        <div class="body">
                            <div >
                                <i class="icon-support"></i>
                                <h5 class="mt-3">Services</h5>
                               
								<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            
                                            <th>SERVICES</th>
                                            <th>PRICE</th>
                                            <th>ANY OFFER</th>
                                            
											<th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($data["service"] as $vendor)
                                        <tr>
                                            
                                            <td>{{$vendor->service_name}}</td>
                                            <td>{{$vendor->service_price}}</td>
                                            <td>{{$vendor->any_offer}}</td>
                                           
											<td class="actions">
                                               
                                                <button class="ser-edt btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#serviceEditModal"
                                                data-toggle="tooltip" data-id="{{$vendor->id}}" data-name="{{$vendor->service_name}}" data-price="{{$vendor->service_price}}" data-offer="{{$vendor->any_offer}}" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></a>
                                              	<button class="ser-del btn btn-sm btn-icon btn-pure btn-default on-default button-remove"data-id="{{$vendor->id}}" data-status="{{$vendor->is_trash}}" data-toggle="modal" data-target="#yesno"
                                                data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                               
                                <a href="javascript:void(0);" class="btn btn-outline-secondary" data-toggle="modal" data-target="#serviceModal">Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
                   <div class="col-lg-12 col-md-12">
                    <div class="card pricing3">
                        <div class="body">
                            <div >
                                <i class="icon-support"></i>
                                <h5 class="mt-3">Time Slots</h5>
                               
								<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                         
                                        <tr>
                                            
                                            <th>TIME SLOTS</th>
                                            <th>MAX-BOOKING-LIMIT</th>
                                          
                                           
											<th>ACTION</th>
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                    @foreach($data["timeslot"] as $vendor)
                                        <tr>
                                            
                                            <td>{{$vendor->timing}}</td>
                                            <td>{{$vendor->max_limit_booking}}</td>
                                           
                                            
											<td class="actions">
                                               
                                                	<button class="time-del btn btn-sm btn-icon btn-pure btn-default on-default button-remove"data-id="{{$vendor->id}}" data-status="{{$vendor->is_trash}}" data-toggle="modal" data-target="#yesno"
                                                data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                               
                                <a href="javascript:void(0);" id="addTimeslot" class="btn btn-outline-secondary" data-toggle="modal" data-target="#timeModal">Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-12 col-md-12">
                    <div class="card pricing3">
                        <div class="body">
                            <div >
                                <i class="icon-support"></i>
                                <h5 class="mt-3">Weekly Shedule</h5>
                               
								<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                         
                                        <tr>
                                            <th>DAY</th>
                                            <th>STATUS</th>
                                            <th>Action</th>
									     </tr>
                                       
                                    </thead>
                                    <tbody>
                                    @foreach($data["week"] as $vendor)
                                        <tr>
                                            <td>SUN</td>
                                            <td>
                                            @if($vendor->sun =='1')
                                            <span class="badge badge-success">Open</span>
                                            @else
                                            <span class="badge badge-danger">Close</span>
                                            @endif
                                            </td>
                                            <td>
                                            <button class="daily btn btn-sm btn-icon btn-pure btn-default on-default button-remove" data-day="sun" data-status="{{$vendor->sun}}" data-toggle="modal" data-target="#weekyesno"
                                                data-toggle="tooltip" data-original-title="Disable"><i class="icon-lock" aria-hidden="true"></i></a>
											</td>
                                         </tr>
                                         <tr>
                                            <td>MON</td>
                                            <td>
                                            @if($vendor->mon =='1')
                                            <span class="badge badge-success">Open</span>
                                            @else
                                            <span class="badge badge-danger">Close</span>
                                            @endif
                                            </td>
                                            <td>
                                            <button class="daily btn btn-sm btn-icon btn-pure btn-default on-default button-remove" data-day="mon" data-status="{{$vendor->mon}}" data-toggle="modal" data-target="#weekyesno"
                                                data-toggle="tooltip" data-original-title="Disable"><i class="icon-lock" aria-hidden="true"></i></a>
											</td>
                                         </tr>
                                         <tr>
                                            <td>TUE</td>
                                            <td>
                                            @if($vendor->tue =='1')
                                            <span class="badge badge-success">Open</span>
                                            @else
                                            <span class="badge badge-danger">Close</span>
                                            @endif
                                            </td>
                                            <td>
                                            <button class="daily btn btn-sm btn-icon btn-pure btn-default on-default button-remove" data-day="tue" data-status="{{$vendor->tue}}" data-toggle="modal" data-target="#weekyesno"
                                                data-toggle="tooltip" data-original-title="Disable"><i class="icon-lock" aria-hidden="true"></i></a>
											</td>
                                         </tr>
                                         <tr>
                                            <td>WED</td>
                                            <td>
                                            @if($vendor->wed =='1')
                                            <span class="badge badge-success">Open</span>
                                            @else
                                            <span class="badge badge-danger">Close</span>
                                            @endif
                                            </td>
                                            <td>
                                            <button class="daily btn btn-sm btn-icon btn-pure btn-default on-default button-remove" data-day="wed" data-status="{{$vendor->wed}}" data-toggle="modal" data-target="#weekyesno"
                                                data-toggle="tooltip" data-original-title="Disable"><i class="icon-lock" aria-hidden="true"></i></a>
											</td>
                                         </tr>
                                         <tr>
                                            <td>THU</td>
                                            <td>
                                            @if($vendor->thu =='1')
                                            <span class="badge badge-success">Open</span>
                                            @else
                                            <span class="badge badge-danger">Close</span>
                                            @endif
                                            </td>
                                            <td>
                                            <button class="daily btn btn-sm btn-icon btn-pure btn-default on-default button-remove" data-day="thu" data-status="{{$vendor->thu}}" data-toggle="modal" data-target="#weekyesno"
                                                data-toggle="tooltip" data-original-title="Disable"><i class="icon-lock" aria-hidden="true"></i></a>
											</td>
                                         </tr>
                                         <tr>
                                            <td>FRI</td>
                                            <td>
                                            @if($vendor->fri =='1')
                                            <span class="badge badge-success">Open</span>
                                            @else
                                            <span class="badge badge-danger">Close</span>
                                            @endif
                                            </td>
                                            <td>
                                            <button class="daily btn btn-sm btn-icon btn-pure btn-default on-default button-remove" data-day="fri" data-status="{{$vendor->fri}}" data-toggle="modal" data-target="#weekyesno"
                                                data-toggle="tooltip" data-original-title="Disable"><i class="icon-lock" aria-hidden="true"></i></a>
											</td>
                                         </tr>
                                         <tr>
                                            <td>SAT</td>
                                            <td>
                                            @if($vendor->sat =='1')
                                            <span class="badge badge-success">Open</span>
                                            @else
                                            <span class="badge badge-danger">Close</span>
                                            @endif
                                            </td>
                                            <td>
                                            <button class="daily btn btn-sm btn-icon btn-pure btn-default on-default button-remove" data-day="sat" data-status="{{$vendor->sat}}" data-toggle="modal" data-target="#weekyesno"
                                                data-toggle="tooltip" data-original-title="Disable"><i class="icon-lock" aria-hidden="true"></i></a>
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
                                <h5 class="mt-3">Bank Details</h5>
                               
								<div class="table-responsive">
                                <table class="table">
                                    
                                       
                                   
                                    <thead>
                                    @foreach($data["bankdetails"] as $vendor)
                                        <tr>
                                            
                                            <td>Account Number</td>
                                            <th>{{$vendor->account_no}}</th>
                                           
                                        </tr>
                                        <tr>
                                            
                                            <td>Account Holder Name</td>
                                            <th>{{$vendor->account_holder}}</th>
                                           
                                        </tr>
                                        <tr>
                                            
                                            <td>Bank Name</td>
                                            <th>{{$vendor->bank_name}}</th>
                                           
                                        </tr>
                                        <tr>
                                            
                                            <td>Branch Name</td>
                                            <th>{{$vendor->branch_name}}</th>
                                           
                                        </tr>
                                        <tr>
                                            
                                            <td>IFSC Code</td>
                                            <th>{{$vendor->ifsc_code}}</th>
                                           
                                        </tr>
                                       
                                     @endforeach
                                     </thead>
                                </table>
                            </div>
                               
                                <a href="javascript:void(0);" id="addTimeslot" class="btn btn-outline-secondary" data-toggle="modal" data-target="#bankModal">Update Now</a>
                            </div>
                        </div>
                    </div>
                </div>
               
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
                            <div class="modal fade" id="yesno" tabindex="-1" role="dialog" aria-labelledby="yesno" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="yesno_title">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="yesno_msg">Woohoo, you're reading this text in a modal!</p>
                                             <input type = "hidden" id = "yesno_id" name = "sid1" value = "0">
                                              <input type = "hidden" id = "yesno_sts" name = "sid2" value = "0">
                                              <input type = "hidden" id = "yesno_trig" name = "sid3" value = "0">
                                              <input type = "hidden" id = "yesno_type" name = "sid4" value = "0">
                                        </div>
                                         <div id="yesnoErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="yesnoSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" id="yesno_ok" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Block all btn -->
                            <div class="modal fade" id="all_block" tabindex="-1" role="dialog" aria-labelledby="all_block" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="block_title">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                              <div class="col-lg-12 col-md-12">
                                              <label><span id="block_head">Service Name : </span><span id="block_content" style="color:red">Hair Cutting</span></label>
                                              </div>
                                              <div class="col-lg-12 col-md-12">
                                                 <label>   Block Date (dd-mm-yyyy)</label>
                                                 <div class="input-group mb-3">                                        
                                                     <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd-mm-yyyy">
                                                </div>
                                             </div>
                                             <div class=" col-lg-12 col-md-12 input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Remarks</span>
                                                </div>
                                                 <textarea class="form-control" aria-label="With textarea"></textarea>
                                             </div>
                                             <input type = "hidden" id = "blocking_id" name = "sid1" value = "0">
                                              
                                              <input type = "hidden" id = "block_trig" name = "sid3" value = "0">
                                             
                                        </div>
                                         <div id="yesnoErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="yesnoSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" id="yesno_ok" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Change Week Shedule btn -->
                            <div class="modal fade" id="weekyesno" tabindex="-1" role="dialog" aria-labelledby="yesno" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="yesno_title">Change Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="yesno_msg">Are you sure to change the status ?</p>
                                               @foreach($data["week"] as $vendor)
                                              <input type = "hidden" id = "week_id" name = "sid188" value = "{{$vendor->id}}">
                                              <input type = "hidden" id = "sun_sts" name = "sid458" value = "{{$vendor->sun}}">
                                              <input type = "hidden" id = "mon_sts" name = "sid248" value = "{{$vendor->mon}}">
                                              <input type = "hidden" id = "tue_sts" name = "sid358" value = "{{$vendor->tue}}">
                                              <input type = "hidden" id = "wed_sts" name = "sid478" value = "{{$vendor->wed}}">
                                              <input type = "hidden" id = "thu_sts" name = "sid198" value = "{{$vendor->thu}}">
                                              <input type = "hidden" id = "fri_sts" name = "sid288" value = "{{$vendor->fri}}">
                                              <input type = "hidden" id = "sat_sts" name = "sid310" value = "{{$vendor->sat}}">
                                              @endforeach
                                        </div>
                                         <div id="weekErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="weekSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" id="week_ok" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal For Add New Service -->
                            <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form  role="form" >
                                        <div class="modal-body">
                                            <form id="service_form" enctype="multipart/form-data" action="" method="post"/>
                                            <input type = "hidden" id="_token" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <input type = "hidden" id = "vid" name = "vid" value = "{{$vid}}">
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Service Name</span>
                                                </div>
                                                 <input type="text" id="service" name="service" class="form-control"  aria-label="Service Name" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Service Price</span>
                                                </div>
                                                 <input type="number" id="price" name="price" class="form-control"  aria-label="Service Price" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Indivisual Discount (%)</span>
                                                </div>
                                                 <input type="number" id="offer" name="offer" class="form-control"  aria-label="If Any Offer" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">Service Icon</span>
                                            </div>
                                            <input type="file"  name="logo" class="form-control" id="service_icon">
                                            </div>
                                            <div id="ServErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                             <div id="ServSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="AddnewServices" class="btn btn-primary">Save </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal For Add New Time Slot -->
                            <div class="modal fade" id="timeModal" tabindex="-1" role="dialog" aria-labelledby="timeModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New Time Slot</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form  role="form" >
                                        <div class="modal-body">
                                            
                                            <input type = "hidden" id="_token" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <input type = "hidden" id = "vid" name = "vid" value = "{{$vid}}">
                                             
                                             <div class="col-lg-12 col-md-12">
                                                <b>From Time (12 hour)</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-clock"></i></span>
                                                    </div>
                                                    <input type="text" id="from_time" class="form-control time12" placeholder="Ex: 11:59 pm">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <b>To Time (12 hour)</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-clock"></i></span>
                                                    </div>
                                                    <input type="text" id="to_time" class="form-control time12" placeholder="Ex: 11:59 pm">
                                                </div>
                                            </div>
                                             <div class="col-lg-12 col-md-12">
                                                <b>Max Booking Limit</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-calculator"></i></span>
                                                    </div>
                                                    <input type="number" id="max_book" class="form-control " >
                                                </div>
                                            </div>


                                            <div id="timeErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                             <div id="timeSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="AddnewTimeslot" class="btn btn-primary">Save </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal For Edit Service -->
                            <div class="modal fade" id="serviceEditModal" tabindex="-1" role="dialog" aria-labelledby="serviceEditModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form  role="form" >
                                        <div class="modal-body">
                                            
                                            <input type = "hidden" id="_token" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <input type = "hidden" id = "vid_edit" name = "sid" value = "{{$vid}}">
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Service Name</span>
                                                </div>
                                                 <input type="text" id="service_edit" name="service" class="form-control"  aria-label="Service Name" aria-describedby="basic-addon1" disabled>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Service Price</span>
                                                </div>
                                                 <input type="number" id="price_edit" name="price" class="form-control"  aria-label="Service Price" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Indivisual Discount (%)</span>
                                                </div>
                                                 <input type="number" id="offer_edit" name="offer" class="form-control"  aria-label="If Any Offer" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">Service Icon</span>
                                            </div>
                                            <input type="file"  name="logo" class="form-control" id="service_edit_icon">
                                            </div>
                                            <div id="editServErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                             <div id="editServSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="EditServices" class="btn btn-primary">Save Changes </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal For Edit Service -->
                            <div class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="bankModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form  role="form" >
                                        <div class="modal-body">
                                             @foreach($data["bankdetails"] as $vendor)
                                            <input type = "hidden" id="_token" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <input type = "hidden" id = "bank_id" name = "sid" value = "{{$vendor->id}}">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Account No</span>
                                                </div>
                                                 <input type="number" id="acno" value="{{$vendor->account_no}}" name="acno" class="form-control"  aria-label="Service Price" aria-describedby="basic-addon1">
                                            </div>
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Account Holder Name</span>
                                                </div>
                                                 <input type="text" id="holder" value="{{$vendor->account_holder}}" name="holder" class="form-control"  aria-label="Service Name" aria-describedby="basic-addon1" >
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Bank Name</span>
                                                </div>
                                                 <input type="text" id="bank_name" value="{{$vendor->bank_name}}" name="holder" class="form-control"  aria-label="Service Name" aria-describedby="basic-addon1" >
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Branch Name</span>
                                                </div>
                                                 <input type="text" id="branch_name" value="{{$vendor->branch_name}}" name="branch_name" class="form-control"  aria-label="Service Name" aria-describedby="basic-addon1" >
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">IFSC Code</span>
                                                </div>
                                                 <input type="text" id="ifsc_code" name="ifsc_code" value="{{$vendor->ifsc_code}}" class="form-control"  aria-label="Service Price" aria-describedby="basic-addon1">
                                            </div>
                                            @endforeach
                                            <div id="bankErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                             <div id="bankSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="bankSave" data-id="{{$vendor->id}}" class="btn btn-primary">Save Changes </button>
                                        </div>
                                        </form>
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
             //Service New Add Part =========================
             
            jQuery('#AddnewServices').click(function(e){
                e.preventDefault();
                jQuery('#ServErr').hide();
                jQuery('#ServSuc').hide();
                
                var formData = new FormData();
                var files = $('#service_icon')[0].files[0]; 
                formData.append('file', files);
                formData.append('price', jQuery('#price').val());
                formData.append('service', jQuery('#service').val());
                formData.append('offer',jQuery('#offer').val());
                formData.append('vid', jQuery('#vid').val());
                $.ajaxSetup({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
                });
               jQuery.ajax({
                  url: "{{ url('addServices') }}",
                  method: 'post',
                  data:formData,
                  contentType: false,
                  processData: false,
                  success: function(result)
                  {
                        var pk = result.success;
                    
                        if(result.status==1)
                        {
                                jQuery('#ServSuc').show();
                                jQuery('#ServSuc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 3000);
                        }
                        else if(result.status==0)
                        {
                                jQuery('#ServErr').show();
                                jQuery('#ServErr').html(pk[Object.keys(pk)[0]]);
                        }
                        else
                        {
                                jQuery('#ServErr').show();
                                jQuery('#ServErr').html(result.success);
                        }
                    
                  }
                });
                  
             });
            
               //==========================================================================
                 //Update Bank Details =========================
            jQuery('#bankSave').click(function(e){
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
                  url: "{{ url('/updatebankdetails') }}",
                  method: 'post',
                  data: 
                  {
                     acno: jQuery('#acno').val(),
                     holder: jQuery('#holder').val(),
                     bank: jQuery('#bank_name').val(),
                    branch: jQuery('#branch_name').val(),
                     ifsc: jQuery('#ifsc_code').val(),
                     vid: jQuery('#bank_id').val()
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
            
               //==========================================================================
               
             //Time Slot New Add Part =========================
            jQuery('#AddnewTimeslot').click(function(e){
                    jQuery('#timeErr').hide();
                    jQuery('#timeSuc').hide();
                    e.preventDefault();
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('addTimeslot') }}",
                  method: 'post',
                  data: 
                  {
                     fromtime: jQuery('#from_time').val(),
                     totime: jQuery('#to_time').val(),
                     maxbook: jQuery('#max_book').val(),
                     vid: jQuery('#vid').val()
                  },
                  success: function(result)
                  {
                        var pk = result.success;
                    
                        if(result.status==1)
                        {
                                jQuery('#timeSuc').show();
                                jQuery('#timeSuc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 3000);
                        }
                        else if(result.status==0)
                        {
                                jQuery('#timeErr').show();
                                jQuery('#timeErr').html(pk[Object.keys(pk)[0]]);
                        }
                        else
                        {
                                jQuery('#timeErr').show();
                                jQuery('#timeErr').html(result.success);
                        }
                    
                  }
                });
                  
             });
            
               //==========================================================================

                //Service Edit Part =========================
            jQuery('#EditServices').click(function(e){
                    jQuery('#editServErr').hide();
                    jQuery('#editServSuc').hide();
                    e.preventDefault();
                    var formData = new FormData();
                    var files = $('#service_edit_icon')[0].files[0]; 
                    if(files){
                        formData.append('file', files);
                    }
                    formData.append('price', jQuery('#price_edit').val());
                    formData.append('service', jQuery('#service_edit').val());
                    formData.append('offer',jQuery('#offer_edit').val());
                    formData.append('vid', jQuery('#vid_edit').val());
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('/updateServices') }}",
                  method: 'post',
                  data:formData,
                  contentType: false,
                  processData: false,
                  success: function(result)
                  {
                        var pk = result.success;
                    
                        if(result.status==1)
                        {
                                jQuery('#editServSuc').show();
                                jQuery('#editServSuc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 3000);
                        }
                        else if(result.status==0)
                        {
                                jQuery('#editServErr').show();
                                jQuery('#editServErr').html(pk[Object.keys(pk)[0]]);
                        }
                        else
                        {
                                jQuery('#editServErr').show();
                                jQuery('#editServErr').html(result.success);
                        }
                    
                  }
                });
                  
             });

             //=============================================================================

              //Yes No Box =========================
            jQuery('#yesno_ok').click(function(e){
                    jQuery('#yesnoServErr').hide();
                    jQuery('#yesnoServSuc').hide();
                    e.preventDefault();
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('changeStatus') }}",
                  method: 'post',
                  data: 
                  {
                     id: jQuery('#yesno_id').val(),
                     sts: jQuery('#yesno_sts').val(),
                     trig:jQuery('#yesno_trig').val(),
                     type:jQuery('#yesno_type').val()
                    
                  },
                  success: function(result)
                  {
                        //alert(result.status);
                        if(result.status==1)
                        {
                                jQuery('#yesnoSuc').show();
                                jQuery('#yesnoSuc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 3000);
                        }
                       
                        else
                        {
                                jQuery('#yesnoErr').show();
                                jQuery('#yesnoErr').html(result.success);
                        }
                    
                  }
                });
                  
             });

             //=============================================================================
              // week Yes No Box =========================
            jQuery('#week_ok').click(function(e){
                    jQuery('#weekErr').hide();
                    jQuery('#weekSuc').hide();
                    e.preventDefault();
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('/changeweekStatus') }}",
                  method: 'post',
                  data: 
                  {
                     id: jQuery('#week_id').val(),
                     sun: jQuery('#sun_sts').val(),
                     mon: jQuery('#mon_sts').val(),
                     tue: jQuery('#tue_sts').val(),
                     wed: jQuery('#wed_sts').val(),
                     thu: jQuery('#thu_sts').val(),
                     fri: jQuery('#fri_sts').val(),
                     sat: jQuery('#sat_sts').val(),
                    
                  },
                  success: function(result)
                  {
                        //alert(result.status);
                        if(result.status==1)
                        {
                                jQuery('#weekSuc').show();
                                jQuery('#weekSuc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 2000);
                        }
                       
                        else
                        {
                                jQuery('#weekErr').show();
                                jQuery('#weekErr').html(result.success);
                        }
                    
                  }
                });
                  
             });

             //=============================================================================
               
               jQuery('.daily').click(function(e){
                   //$('#serviceEditModal').modal('show');
                   var d_day = $(this).data("day") ;
                   var d_sts = $(this).data("status") ;

                   var s = '0';
                   if(d_sts=='0')
                   {
                       s = '1';
                   }
                  var asm = d_day+"_sts";
                  jQuery('#'+asm).val(s);
                  
               });
            //=================================================
             //=============================================================================
               
               jQuery('.ser-edt').click(function(e){
                   //$('#serviceEditModal').modal('show');
                   var service_id = $(this).data("id") ;
                   var service_name = $(this).data("name") ;
                   var service_price = $(this).data("price") ;
                   var service_offer = $(this).data("offer") ;
                  // alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);

                   jQuery('#sid').val(service_id);
                   jQuery('#service_edit').val(service_name);
                   jQuery('#price_edit').val(service_price);
                   jQuery('#offer_edit').val(service_offer);
                  // alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
                  // jQuery("#serviceEditModal").modal("show");
                 //  alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
               });
            //=================================================
            //=============================================================================
               
               jQuery('.ser-dis').click(function(e){
                   //$('#serviceEditModal').modal('show');
                   var service_id = $(this).data("id") ;
                   var service_sts = $(this).data("status") ;
                  // alert(service_id+"-"+service_sts);
                   var ch_sts = 0;
                   if(service_sts === 0)
                   {
                       ch_sts = 1;
                   }
                   jQuery('#yesno_title').text('Change Status');
                   jQuery('#yesno_msg').text('Are you sure to change the status ?');
                   jQuery('#yesno_id').val(service_id);
                   jQuery('#yesno_sts').val(ch_sts);
                   jQuery('#yesno_trig').val('1');
                   jQuery('#yesno_type').val('enable');
                  
                  // alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
                  // jQuery("#serviceEditModal").modal("show");
                 //  alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
               });
            //=================================================
            //=============================================================================
               
               jQuery('.time-dis').click(function(e){
                   //$('#serviceEditModal').modal('show');
                   var service_id = $(this).data("id") ;
                   var service_sts = $(this).data("status") ;
                  // alert(service_id+"-"+service_sts);
                   var ch_sts = 0;
                   if(service_sts === 0)
                   {
                       ch_sts = 1;
                   }
                   jQuery('#yesno_title').text('Change Status');
                   jQuery('#yesno_msg').text('Are you sure to change the status ?');
                   jQuery('#yesno_id').val(service_id);
                   jQuery('#yesno_sts').val(ch_sts);
                   jQuery('#yesno_trig').val('3');
                   jQuery('#yesno_type').val('enable');
                  
                  // alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
                  // jQuery("#serviceEditModal").modal("show");
                 //  alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
               });
            //=================================================
             //=============================================================================
               
               jQuery('.ser-del').click(function(e){
                   //$('#serviceEditModal').modal('show');
                   var service_id = $(this).data("id") ;
                   var service_sts = $(this).data("status") ;
                  // alert(service_id+"-"+service_sts);
                   var ch_sts = 0;
                   if(service_sts === 0)
                   {
                       ch_sts = 1;
                   }
                   jQuery('#yesno_title').text('Delete Item');
                   jQuery('#yesno_msg').text('Are you sure to delete this item  ?');
                   jQuery('#yesno_id').val(service_id);
                   jQuery('#yesno_sts').val(ch_sts);
                   jQuery('#yesno_trig').val('1');
                   jQuery('#yesno_type').val('trash');
                  // alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
                  // jQuery("#serviceEditModal").modal("show");
                 //  alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
               });
            //=================================================
            //=============================================================================
               
               jQuery('.time-del').click(function(e){
                   //$('#serviceEditModal').modal('show');
                   var service_id = $(this).data("id") ;
                   var service_sts = $(this).data("status") ;
                  // alert(service_id+"-"+service_sts);
                   var ch_sts = 0;
                   if(service_sts === 0)
                   {
                       ch_sts = 1;
                   }
                   jQuery('#yesno_title').text('Delete Item');
                   jQuery('#yesno_msg').text('Are you sure to delete this item  ?');
                   jQuery('#yesno_id').val(service_id);
                   jQuery('#yesno_sts').val(ch_sts);
                   jQuery('#yesno_trig').val('3');
                   jQuery('#yesno_type').val('trash');
                  // alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
                  // jQuery("#serviceEditModal").modal("show");
                 //  alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
               });
            //=================================================
            //================ Upload Image ====================
            /*Add new catagory Event*/
            $("#upimg").click(function(){
            //alert('hi');
                $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                url: "{{ url('changeprofilepic') }}",
                method: 'post',
                data:new FormData($("#upload_form")[0]),
                dataType:'json',
                async:false,
                type:'post',
                processData: false,
                contentType: false,
                success:function(result){
                    var pk = result.success;
                                
                    if(result.status==1)
                    {
                            
                            setTimeout(function(){ location.reload(); }, 2000);
                    }
                    else if(result.status==0)
                    {
                            alert(k[Object.keys(pk)[0]]);
                    }
                    else
                    {
                            alert(k[Object.keys(pk)[0]]);
                    }
                },
                });

            });
 //=================================
           
    //=============================================================================
        
        jQuery('.act').click(function(e){
            //$('#serviceEditModal').modal('show');
            var service_id = $(this).data("id") ;
            var service_sts = $(this).data("status") ;
            // alert(service_id+"-"+service_sts);
            var ch_sts = 'Active';
            if(service_sts =='Active')
            {
                ch_sts = 'Deactive';
            }
            jQuery('#yesno_title').text('Change Status');
            jQuery('#yesno_msg').text('Are you sure to change the status ?');
            jQuery('#yesno_id').val(service_id);
            jQuery('#yesno_sts').val(ch_sts);
            jQuery('#yesno_trig').val('0');
            jQuery('#yesno_type').val('enable');
            
            // alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
            // jQuery("#serviceEditModal").modal("show");
            //  alert(service_id+"-"+service_name+"-"+service_price+"-"+service_offer);
        });
    //=================================================
    // Save update changes of service
    
        //=====================================================================
    });
    //===============================================
           
      </script>
 </body>

 </html>