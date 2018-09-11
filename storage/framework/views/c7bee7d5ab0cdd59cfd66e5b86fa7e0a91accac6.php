 <!doctype html>
<html lang="en">
<head>
<!-- Include Heaer-->
<?php echo $__env->make('layout.top-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
 <body class="theme-green">
 <!-- Preloder-->
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="../images/icon-light.svg" width="48" height="48" alt="HexaBit"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

 <div id="wrapper">
  <!-- Header-->
 <?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

 <!-- Left-Side bar-->
 <?php echo $__env->make('layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

     <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Vendor List</h2>
                </div>            
                <div class="col-md-6 col-sm-12 text-right">
                   
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">Add New</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Basic Table <small>Basic example without any additional modification classes</small></h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                              
                            </ul>
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
                                       <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($vendor->name); ?></td>
                                                    <td><?php echo e($vendor->addr); ?></td>
                                                    <td><?php echo e($vendor->city); ?></td>
                                                    <td><?php echo e($vendor->contact); ?></td>
                                                    <td>x<?php echo e($vendor->email); ?></td>
                                                    <td><?php echo e($vendor->sts); ?></td>
                                                    <td class="actions">
                                               
											            <button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                        data-toggle="tooltip" data-original-title="View"><i class="icon-eye" aria-hidden="true"></i></a>
                                                        <button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></a>
                                                        <button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></a>
												
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      
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
 <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 </body>
 </html>