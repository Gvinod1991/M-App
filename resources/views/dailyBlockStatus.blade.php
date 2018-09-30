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
                                        <tr>
                                            <td>26-09-2018</td>
                                            <td>
                                           @if($vendor->status ==0) 
                                            <span class="badge badge-success">Open</span>
                                           @else
                                            <span class="badge badge-danger">Closed</span>
                                            <?php  $trig = 1;?>
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
               
                @if($trig ==0) 
                 <div class="col-lg-12 col-md-12">
                    <div class="card pricing3">
                        <div class="body">
                            <div >
                                <i class="icon-support"></i>
                                <h5 class="mt-3">SERVICES BLOCK STATUS (Dt: 26-09-2018)</h5>
                               
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
                                <h5 class="mt-3">TIME-SLOTS BLOCK STATUS (Dt: 26-09-2018)</h5>
                               
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
                                <h5 class="mt-3">SEAT BLOCK STATUS (Dt: 26-09-2018)</h5>
                               
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
 
      
 </body>

 </html>