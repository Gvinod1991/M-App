 <!doctype html>
<html lang="en">
<head>
<!-- Include Heaer-->
@include('layout.top-header')
</head>
 <body class="theme-green">
 <!-- Preloder-->
                 <?php 
                  $burl =  url('/');
                  $avs=array();
                 ?>
                 <input type = "hidden" id = "bur" name = "sid" value = "{{$burl}}">
                 <input type = "hidden" id = "vid" name = "vid" value = '{{$vendor_id}}'>
                 @foreach($data["dayblock"] as $vendor)
                  <?php 
                        
                       // echo $vendor->close_date;
                        $object = new stdClass();
                        $object->title = 'Day Block';
                        $object->start = $vendor->close_date;
                        $object->className = 'bg-danger';
                        array_push($avs,$object);
                   ?>
                @endforeach
                 <?php
                    $sdate = '';
                ?>
                 @foreach($data["service"] as $vendor)
                  <?php 
                        
                       // echo $vendor->close_date;
                        if($sdate != $vendor->block_date)
                        {
                            $object = new stdClass();
                            $object->title = 'Service Block';
                            $object->start = $vendor->block_date;
                            $object->className = 'bg-danger';
                            array_push($avs,$object);
                        }
                        $sdate = $vendor->block_date;
                   ?>
                @endforeach
                 <?php
                    $sdate = '';
                ?>
                 @foreach($data["timeslot"] as $vendor)
                  <?php 
                        
                       // echo $vendor->close_date;
                        if($sdate != $vendor->block_date)
                        {
                              $object = new stdClass();
                                $object->title = 'Time Slot Block';
                                $object->start = $vendor->block_date;
                                $object->className = 'bg-danger';
                                array_push($avs,$object);
                        }
                         $sdate = $vendor->block_date;
                   ?>
                @endforeach

                <?php
                    $sdate = '';
                ?>
                 @foreach($data["seat"] as $vendor)
                  <?php 
                        
                       // echo $vendor->close_date;
                       if($sdate != $vendor->block_date)
                       {
                            $object = new stdClass();
                            $object->title = 'Seat Block ';
                            $object->start = $vendor->block_date;
                            $object->className = 'bg-danger';
                            array_push($avs,$object);
                       }
                       $sdate = $vendor->block_date;
                        
                   ?>
                @endforeach
              <?php
              
              //$js_array = json_encode($avs);
              //echo $js_array;
              ?>
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
                    <h2>Calendar</h2>
                </div>            
                <div class="col-md-12 col-sm-12 text-right" >
                     <a href="{{ url('/vendorProfile/'.$vendor_id) }}" class="btn btn-sm btn-info" title="">View Vendor</a>
                    <a href="{{ url('/viewCallender/'.$vendor_id) }}" class="btn btn-sm btn-primary" title="">Block Callender</a>
                   
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div id="calendar"></div>
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
 
    $(document).ready(function() {
      var ar = <?php echo json_encode($avs) ?>;
     // var vbc = <?php echo $burl; ?>;
       //=================================
      $('#calendar').fullCalendar({
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
    },
    navLinks: true,
	  navLinkDayClick: function(date, jsEvent) {
		console.log('day', date.format()); // date is a moment
		console.log('coords', jsEvent.pageX, jsEvent.pageY);
		//alert(date.format());
        var vid = jQuery('#vid').val();
        var bur = jQuery('#bur').val();
       // alert(jQuery('#bur').val());
        var lik = bur+"/dailyBlockingStatus/"+vid+"/"+date.format();
        window.location.href = (lik);
	  },
	eventLimit: true, // allow "more" link when too many events
    events:ar,
    defaultDate: new Date(),
    editable: false,
    droppable: false, // this allows things to be dropped onto the calendar
    drop: function() {
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            $(this).remove();
        }
    }
   
});
    });
     

    
</script>
 
    

 </body>
 </html>