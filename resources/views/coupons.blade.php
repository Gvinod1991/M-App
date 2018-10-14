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
                    <h2>Coupon List</h2>
                </div>            
                <div class="col-md-6 col-sm-12 text-right">
                    <a> <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-new">Add New Coupon</a>
                                            
                    
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
                                <?php  $today = date("Y-m-d"); ?>
                                    <thead>
                                        <tr>
                                            <th>COUPON CODE</th>
                                            <th>COUPON NAME</th>
                                            <th>STRAT DATE</th>
                                            <th>END DATE</th>
                                             <th>COUPON PRICE</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
											
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>COUPON CODE</th>
                                            <th>COUPON NAME</th>
                                            <th>STRAT DATE</th>
                                            <th>END DATE</th>
                                             <th>COUPON PRICE</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       @foreach($vendors as $vendor)
                                                <tr>
                                                    <td>{{$vendor->coupon_code}}</td>
                                                    <td>{{$vendor->coupon_name}}</td>
                                                    <td>{{$vendor->from_date}}</td>
                                                    <td>{{$vendor->to_date}}</td>
                                                     <td>{{$vendor->price}}</td>
                                                    <td>
                                                     @if($today > $vendor->to_date ) 
                                                    <span class="badge badge-danger">Expired</span>
                                                     @else
                                                     @if($vendor->is_enable == 0 )
                                                    <span class="badge badge-primary">De-Active</span>
                                                     @else
                                                      <span class="badge badge-success">Active</span>
                                                    @endif
                                                    @endif
                                                    </td>
                                                   <td class="actions">
                                               
                                                <button class="cpchs btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#yesno-changests"
                                                data-toggle="tooltip" data-id="{{$vendor->id}}" data-sts="{{$vendor->is_enable}}"  data-original-title="Edit">Change Status</a>
                                                 <button class="cpedt btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#add-new"
                                                data-toggle="tooltip" data-id="{{$vendor->id}}" data-code="{{$vendor->coupon_code}}" data-name="{{$vendor->coupon_name}}" data-from="{{$vendor->from_date}}" data-to="{{$vendor->to_date}}" data-price="{{$vendor->price}}"  data-original-title="Delete">Edit</a>
                                                 <button class="cpdlt btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" data-toggle="modal" data-target="#yesno-del"
                                                data-toggle="tooltip" data-id="{{$vendor->id}}"   data-original-title="Delete">Delete</a>
                                             
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
 <!-- Modal Yes-NO btn -->
                            <div class="modal fade" id="yesno-changests" tabindex="-1" role="dialog" aria-labelledby="yesno-changests" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="yesno_title">Change Coupon Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="yesno_msg">Are you sure to change the status ?</p>
                                             <input type = "hidden" id = "coupon_id" name = "coupon_id" value = "">
                                              <input type = "hidden" id = "coupon_sts" name = "coupon_sts" value = "">
                                            
                                        </div>
                                         <div id="bankErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="bankSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" id="yesno_sts_ok" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="yesno-del" tabindex="-1" role="dialog" aria-labelledby="yesno-del" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="yesno_title">Delete Coupon</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="yesno_msg">Are you sure to delete ?</p>
                                             <input type = "hidden" id = "cpdlt_id" name = "cpdlt_id" value = "">
                                            
                                        </div>
                                         <div id="bankErrr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="bankSucc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" id="yesno_del_ok" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <!-- Modal Block all btn -->
                            <div class="modal fade" id="add-new" tabindex="-1" role="dialog" aria-labelledby="add-new" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="block_title">Add new coupon</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                               <div class="col-lg-12 col-md-12">
                                                 <label>   Coupon Code</label>
                                                 <div class="input-group mb-3"> 
                                                   <input type = "text" class="form-control" id = "cp_code" name = "cp_code" value = "">                                       
                                                </div>
                                             </div>
                                              <div class="col-lg-12 col-md-12">
                                                 <label>   Coupon Name</label>
                                                 <div class="input-group mb-3"> 
                                                   <input type = "text" class="form-control"  id = "cp_name" name = "cp_name" value = "">                                       
                                                </div>
                                             </div>
                                              <div class="col-lg-12 col-md-12">
                                                 <label>   Coupon Price</label>
                                                 <div class="input-group mb-3"> 
                                                   <input type = "number" class="form-control"  id = "cp_price" name = "cp_price" value = "">                                       
                                                </div>
                                             </div>
                                              <div class="col-lg-12 col-md-12">
                                                 <label>   Start Date (dd-mm-yyyy)</label>
                                                 <div class="input-group mb-3">                                        
                                                     <input data-provide="datepicker" id="fdt" data-date-autoclose="true" class="form-control" data-date-format="dd-mm-yyyy">
                                                </div>
                                             </div>
                                              <div class="col-lg-12 col-md-12">
                                                 <label>   End Date (dd-mm-yyyy)</label>
                                                 <div class="input-group mb-3">                                        
                                                     <input data-provide="datepicker" id="tdt" data-date-autoclose="true" class="form-control" data-date-format="dd-mm-yyyy">
                                                </div>
                                             </div>
                                            
                                             <input type = "hidden" id = "blocking_id" name = "sid1" value = "0">
                                              
                                        
                                             
                                        </div>
                                         <div id="addErr" style="display:none" class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
                                        <div id="addSuc" style="display:none" class="alert alert-success" role="alert">A simple danger alert—check it out!</div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="add_ok" class="btn btn-primary">Save</button>
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
              //=============================================================================
               
               jQuery('.cpchs').click(function(e){

                  var cpid = $(this).data("id") ;
                  var cpsts = $(this).data("sts") ;
                  jQuery('#coupon_id').val(cpid);
                  jQuery('#coupon_sts').val(cpsts);
                 
               });
                jQuery('.cpdlt').click(function(e){
                
                   var cpid = $(this).data("id") ;
                   jQuery('#cpdlt_id').val(cpid);

                });
                jQuery('.cpedt').click(function(e){
                
                   jQuery('#blocking_id').val($(this).data("id")) ;
                   jQuery('#cp_code').val($(this).data("code")) ;
                   jQuery('#cp_name').val($(this).data("name")) ;
                   jQuery('#cp_price').val($(this).data("price")) ;
                   $('#fdt').datepicker('setDate', new Date($(this).data("from")));
                   $('#tdt').datepicker('setDate', new Date($(this).data("to")));
                   $("#cp_code").attr("disabled", "disabled"); 
                
                });

                 //================ Change status ====================
              
            jQuery('#yesno_sts_ok').click(function(e){
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
                  url: "{{ url('/couponChangeStatus') }}",
                  method: 'post',
                  data: 
                  {
                     id: jQuery('#coupon_id').val(),
                     sts: jQuery('#coupon_sts').val()
                   
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

             //===============================================
              //================ Delete Coupon ====================
              
            jQuery('#yesno_del_ok').click(function(e){
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
                  url: "{{ url('/couponDelete') }}",
                  method: 'post',
                  data: 
                  {
                     id: jQuery('#cpdlt_id').val()
                   
                  },
                  success: function(result)
                  {
                        //alert(result.status);
                        if(result.status==1)
                        {
                                jQuery('#bankSucc').show();
                                jQuery('#bankSucc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 2000);
                        }
                       
                        else
                        {
                                jQuery('#bankErrr').show();
                                jQuery('#bankErrr').html(result.success);
                        }
                    
                  }
                });
                  
             });

             //===============================================
              //================ Add New ====================
              
            jQuery('#add_ok').click(function(e){
                    jQuery('#addErr').hide();
                    jQuery('#addSuc').hide();
                    e.preventDefault();
                    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
               jQuery.ajax({
                  url: "{{ url('/addCoupon') }}",
                  method: 'post',
                  data: 
                  {
                     id: jQuery('#blocking_id').val(),
                     code: jQuery('#cp_code').val(),
                     name: jQuery('#cp_name').val(),
                     price: jQuery('#cp_price').val(),
                     fdt: jQuery('#fdt').val(),
                     tdt: jQuery('#tdt').val()
                   
                  },
                  success: function(result)
                  {
                         var pk = result.success;
                        if(result.status==1)
                        {
                             
                                jQuery('#addSuc').show();
                                jQuery('#addSuc').html(result.success);
                                setTimeout(function(){ location.reload(); }, 2000);
                        }
                        else if(result.status==0)
                        {
                                jQuery('#addErr').show();
                                jQuery('#addErr').html(pk[Object.keys(pk)[0]]);
                        }
                        else
                        {
                                jQuery('#addErr').show();
                                jQuery('#addErr').html(result.success);
                        }
                    
                  }
                });
                  
             });

             //===============================================
         });
     
</script>
 </body>
 </html>