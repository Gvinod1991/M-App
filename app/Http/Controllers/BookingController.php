<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Services;
use App\Timeslot;
use App\Bankdetails;
use App\Weekshedule;
use App\Closerecord;
use App\Blockseat;
use App\Booking;
use App\Blocktimeslot;
use App\Blockservice;
use Validator;
use Datetime;
use Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facedes\input;


class BookingController extends Controller
{
    // Get Availibility of store  by date and shop id
    //Thi will take two Request input. (book_date,vandor_id)
     public function getAvailibility(Request $request)
    {

        $book_date = $request->book_date;
        $vendor_id = $request->vendor_id;
        $ymd_bookdate = DateTime::createFromFormat('d-m-Y',$book_date)->format('Y-m-d');

        //This is for closing date checking, If get data than Shop is closed on that day.
        //If it wii return data than shop is close that day
        $vnd =  Closerecord::where('close_date',$ymd_bookdate)->where('vendor_id',$vendor_id)->where('is_trash',0)->get();

        if($vnd->isEmpty())
        {

            //Initialize all data array to return
            $alldata = array();
       
     
             //Convert to date;
            $b_day = Carbon\Carbon::createFromFormat('Y-m-d', $ymd_bookdate,'Asia/Kolkata');
            $dt = Carbon\Carbon::now();
            $b_day = $b_day->toDayDateTimeString();
            $myArray = explode(',', $b_day); 
            $dayy = strtolower($myArray[0]);
            // Check for day open-close {If the day status is -0 return Open}// If get data than shop is open , if no data found shop is close
           //If it wii return data than shop is close that day
            $avl_vnd =  Weekshedule::where($dayy,0)->where('vendor_id',$vendor_id)->get();
          
            if($avl_vnd->isEmpty())
            {
                // Get All Active Time Slots Of This Particular Member
                $avl_timeslot =  Timeslot::where('vendor_id',$vendor_id)->where('is_trash',0)->where('is_enable',1)->get();
                if($avl_timeslot->isEmpty())
                {
                    $res=array('status'=>0,"message"=>"No Time-slot available.");
                    return response()->json($res);
                }
                else
                {
                    // $Array toinitilize
                    $a=array();
                   
                   //get all active time slot
                    foreach($avl_timeslot as $i)
                    {
                        //initilize book seat
                        $book_seat = 0;
                        //Get data if any time slot block by date
                        $block_timeslot =  Blocktimeslot::where('block_date',$ymd_bookdate)->where('timeslot_id',$i->id)->where('is_trash',0)->get();
                        if($block_timeslot->isEmpty())
                        {
                            //Get data if any seat block in any time slot on that date
                            $block_seat =  Blockseat::where('block_date',$ymd_bookdate)->where('timeslot_id',$i->id)->where('is_trash',0)->get();
                            if(!$block_seat->isEmpty())
                            {
                                foreach($block_seat as $bs)
                                {
                                    // Asign the no of block seat to $book_seat
                                    $book_seat = $book_seat + $bs->no_seat;
                                }
                            }

                            //Get data if any previous booking has been done on in any time slot on that date
                            $booked_seat =  Booking::where('book_date',$ymd_bookdate)->where('timeslot_id',$i->id)->where('track_sts','ACTIVE')->get();
                            if(!$booked_seat->isEmpty())
                            {
                                foreach($booked_seat as $bsk)
                                {
                                    //Add the no of book seat to $book_seat
                                    $book_seat = $book_seat + $bsk->no_seat;
                                }
                            }

                           //Get the available seat by substract all reserve seat 
                           $avl_seat = $i->max_limit_booking - $book_seat;
                           //Asign that Available seat to that object
                           $i->max_limit_booking = $avl_seat;
                           array_push($a,$i);
                          
                        }
                        
                    }
                     $alldata["timeslot"]= $a;
                    // $res=array('status'=>1,"message"=>"Got Record");
                   // return response()->json($a);
                }

                // Get Services
                // Get All Active Services Of This Particular Member
                $avl_services =  Services::where('vendor_id',$vendor_id)->where('is_trash',0)->where('is_enable',1)->get();
                if($avl_services->isEmpty())
                {
                    // If data Empty
                    $res=array('status'=>0,"message"=>"No Services available.");
                    return response()->json($res);
                }
                else
                {
                    // $Array toinitilize
                    $avs=array();
                   
                   //get all active services
                    foreach($avl_services as $i)
                    {
                      
                        //Get data if any services block by date
                        $block_serv =  Blockservice::where('block_date',$ymd_bookdate)->where('service_id',$i->id)->where('is_trash',0)->get();
                        if($block_serv->isEmpty())
                        {
                           
                           array_push($avs,$i);
                          
                        }
                        
                    }
                    // Asign services array to all data.
                    $alldata["service"]= $avs;
                }

               
            }
            else
            {
                $res=array('status'=>0,"message"=>"Booking is not vailable in this day.");
                return response()->json($res);
                
            }
        }
        else
        {
            $res=array('status'=>0,"message"=>"Booking is not vailable in this day.");
            return response()->json($res);
            
        }
        // Return all data
        $res=array('status'=>1,"message"=>"Got Services");
        return response()->json($alldata);
      
     
    }

     private $rules_booking = array(
        'book_date' => 'required ',
        'vendor_id' => 'required ',
        'timeslot_id' => 'required ',
        'time_slot' => 'required ',
        'service_name' => 'required ', 
        'no_seat' => 'required ', 
        'customer_id' => 'required ',
        'tot_cost' => 'required ', 
        'pay_sts' => 'required '
                          
    );
    //Custom Error Messages
    private $messages_booking = [
                    'book_date' => 'Please Choose the booking date',
                    'vendor_id' => 'Vendor id is required.',
                    'timeslot_id' => 'time-slot id is required.',
                    'time_slot' => 'time-slot name is required.',
                    'service_name' => 'Please select the service.',
                    'no_seat' => 'Please enter the number of seat you want to booking.',
                    'customer_id' => 'Custommer id is required.',
                    'tot_cost' => 'total cost is required.',
                    'pay_sts' => 'Pay status is required.'
                    ];


     //================================ New Booking ========================================================
    public function newBooking(Request $request)
    {
       
        $failure_message='Error !';
        $validator = Validator::make($request->all(),$this->rules_booking,$this->messages_booking);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'success'=>$validator->errors()));
        }
        else
        {
            $ymd_bookdate = DateTime::createFromFormat('d-m-Y',$request->book_date)->format('Y-m-d');
            $bk = new Booking();
            $bk->book_date = $ymd_bookdate;
            $bk->vendor_id = $request->vendor_id;
            $bk->timeslot_id = $request->timeslot_id;
            $bk->time_slot = $request->time_slot;
            $bk->book_service = $request->service_name;
            $bk->no_seat = $request->no_seat;
            $bk->customer_id = $request->customer_id;
            $bk->tot_cost = $request->tot_cost;
            $bk->pay_sts = $request->pay_sts;

             if($bk->save())
            {
                    return response()->json(['status'=>1,'success'=>'Booking Successfull']);
            }
            else
            {
                return response()->json(['status'=>-1,'success'=>'InternalError']);
            }

           
        }
        
        
    }
    //============================== Get Bookings Records ===========================
    public function getBookingHistory($id)
    {
        
          $book_list=false;
            $book_list =  Booking::join('public_user','booking_details.customer_id','=','public_user.id')
            ->where('booking_details.vendor_id','=', $id)
            ->get();
            return view('mybookings',["bookings"=>$book_list]);
        
        
        //$vnd =  Vendor::where('is_trash',1)->get();
        //return view('mybookings')->with('vendors',$vnd);
    }
    //================================================================================
    /*
    *Method to get all bookings 
    */
    public function bookings(Request $request)
    {
         $xtp=\Session::get('user_type');
        if($xtp > 0)
        {
            $id = $xtp;
        }
        $book_list=false;
        $book_list =  Booking::
        join('vendors','booking_details.vendor_id','=','vendors.id')
        ->join('public_user','booking_details.customer_id','=','public_user.id')
        ->get();
        return view('bookings',["bookings"=>$book_list]);
       
    }
    // Show all booking of Custommer
     public function showAllBooking($id)
    {
        $book_list =  Booking::where('customer_id',$id)->get();
        return response()->json($book_list);
       
    }
    
    // Show all booking of Custommer
     public function showSingleBooking($id)
    {
        $book_list =  Booking::where('id',$id)->get();
        return response()->json($book_list);
       
    }
     //=============== Cancel Booking =========================================
    public function cancelBooking(Request $request)
    {
        if(Booking::where('id',$request->id)->update(['track_sts' => 'CANCEL']))
        {
            return response()->json(['status'=>1,'success'=>'Booking Cancelled.']);
        }
        else
        {
            return response()->json(['status'=>-1,'success'=>'InternalError']);
        } 
    }
     //=============== Gender Search =========================================
    public function genderSearch(Request $request)
    {
        
         $vnd =  Vendor::where('is_trash',1)->where('sts','Active')->where('gender',$request->gender)->get();
        if(!$vnd->isEmpty())
        {
             return response()->json($vnd);
        }
        else
        {
            $res=array('status'=>0,"message"=>"No data Found");
            return response()->json($res);
        }
    }
    //=============== City Search =========================================
    public function citySearch(Request $request)
    {
        
         $vnd =  Vendor::where('is_trash',1)->where('sts','Active')->where('city', 'like', '%' . $request->city . '%')->get();
        if(!$vnd->isEmpty())
        {
             return response()->json($vnd);
        }
        else
        {
            $res=array('status'=>0,"message"=>"No data Found");
            return response()->json($res);
        }
    }
    //=============== City with locality Search =========================================
    public function cityWithlocalitySearch(Request $request)
    {
        
         $vnd =  Vendor::where('is_trash',1)->where('sts','Active')->where('city', 'like', '%' . $request->city . '%')->where('locality', 'like', '%' . $request->locality . '%')->get();
        if(!$vnd->isEmpty())
        {
             return response()->json($vnd);
        }
        else
        {
            $res=array('status'=>0,"message"=>"No data Found");
            return response()->json($res);
        }
    }
    //=============== get price range =========================================
    public function getPricerange()
    {
         $avl_services =  Services::where('is_trash',0)->where('is_enable',1)->get();
        if(!$avl_services->isEmpty())
        {
            $max_p = 0;
            $min_p = 0;
             foreach($avl_services as $bsk)
            {
                //Add the no of book seat to $book_seat
                if($bsk->service_price > $max_p) 
                {
                        $max_p = $bsk->service_price;
                }
                if($bsk->service_price < $min_p) 
                {
                        $min_p = $bsk->service_price;
                }
            }
            $res=array('status'=>1,"max"=>$max_p,"min"=>$min_p);
            return response()->json($res);
        }
        else
        {
            $res=array('status'=>0,"message"=>"No data Found");
            return response()->json($res);
        }
    }
    //=======================================================================================
   // Default query parameter : http://localhost/my-style-app/api/public-user/getListShop/Bhubaneswar/NO/NO/-1/-1
    public function getFilterList($city,$locality,$gender,$min,$max)
    {
        $query= DB::table('vendors')
        ->select('*')
        ->where('vendors.city', 'like', '%' . $city . '%');
        
        if($locality != 'NO')
        {
            $query->where('vendors.locality', 'like', '%' . $locality . '%') ;
           
        }
        if($gender == 'Male' || $gender == 'Female' || $gender == 'Both' )
        {
            $query->where('vendors.gender', '=', $gender) ;
           
        }
        if($min != -1 && $max != -1)
        {
          
            $query->join('services','vendors.id','services.vendor_id');
            $query->whereBetween('services.service_price', [$min, $max]);
           
        }

        $data=$query->get();
        if(sizeof($data)>0)
        {
            $res=array("status"=>1,"message"=>"Booking data retrived successfully!","data"=>$data);
            return response()->json($res);
        }
        else
        {
            $res=array("status"=>0,"message"=>"Booking data retrival failed!");
            return response()->json($res);
        }
      
    }
}