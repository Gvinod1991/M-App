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
       
        <div class="container-fluid">
           
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add/Edit Vendor</h2> 
                            <div class="pull-right">
                                <a href="{{route('vendors')}}"  class="btn btn-sm btn-primary" title="">Back</a>
                            </div>
                        </div>
                        <div class="body">
                            @if(sizeof(Session::get('errors') ) > 0 )
                            {!! Html::ul(Session::get('errors'), array('class'=>'alert alert-danger errors')) !!}
                            @endif  
                            @if(Session::has('flash_message'))
                                <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>{{ Session::get('flash_message') }}</div>
                            @elseif(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>{{ Session::get('error_message') }}</div>
                            @endif 
                            {!! Form::model($vendor, ['action' => 'AddVendorController@saveVendor']) !!}
                            {!! Form::hidden('id', null, []) !!}
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" />

                                <div class="form-group">
                                    {!! Form::label('name', 'Shop Name') !!}
                                    {!! Form::text('shop_name', null, ['class' => 'form-control','required'=> 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Description') !!}
                                    {!! Form::textarea('description', null, ['class' => 'form-control','rows' => 3, 'cols' => 30,'required'=> 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Service Given To') !!}
                                    {!! Form::select('gender',array('Male' => 'Male', 'Female' => 'Female', 'Both' => 'Both'),$selected,['class'=>'form-control','required'=> 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Owner Name') !!}
                                    {!! Form::text('owner_name', null, ['class' => 'form-control','required'=> 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Email Id') !!}
                                    {!! Form::text('email', null, ['class' => 'form-control','required'=> 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('user_type', 'State') !!}
                                    {!! Form::select('state',$statesList,$selected_state,['class'=>'form-control','required'=> 'required']) !!}
                                </div>
								<div class="form-group">
                                    {!! Form::label('name', 'City') !!}
                                    {!! Form::text('city', null, ['class' => 'form-control']) !!}
                                </div>
								<div class="form-group">
                                    {!! Form::label('name', 'Locality') !!}
                                    {!! Form::text('locality', null, ['class' => 'form-control','required'=> 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Address') !!}
                                    {!! Form::textarea('addr', null, ['class' => 'form-control','rows' => 3, 'cols' => 30,'required'=> 'required']) !!}
                                </div>
								<div class="form-group">
                                    {!! Form::label('name', 'Contact No') !!}
                                    {!! Form::text('contact', null, ['class' => 'form-control','required'=> 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Facebook Profile') !!}
                                    {!! Form::text('facebook_link', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Twitter Profile') !!}
                                    {!! Form::text('twiter_link', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Youtube Profile') !!}
                                    {!! Form::text('youtube_link', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Instagram Profile') !!}
                                    {!! Form::text('instagram_link', null, ['class' => 'form-control']) !!}
                                </div>
                                <br>
                                {!! Form::Submit('Save', ['name' => 'submit','class'=>'btn btn-success']) !!}
                               
                                {!! Form::close() !!}
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
 </body>
 </html>