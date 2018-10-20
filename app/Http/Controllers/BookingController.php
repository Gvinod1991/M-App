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
use App\ServiceCatagory;
use App\BookingSummery;
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
        
        //dd();
        $ymd_bookdate = Date('Y-m-d',strtotime($book_date));
        $res=array('status'=>1,"message"=>"Got Services");

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
        $res=array('status'=>1,"message"=>"Got Services",'vendorData'=>$alldata);
        return response()->json($res);
      
     
    }

     private $rules_booking = array(
        'book_date' => 'required ',
        'vendor_id' => 'required ',
        'arr_timeslot_id.*' => 'required ',
        'arr_timeslot_name.*' => 'required ',
        'arr_services.*' => 'required ', 
        'arr_no_seat.*' => 'required ', 
         'arr_prices.*' => 'required ', 
        'customer_id' => 'required ',
        'tot_cost' => 'required ', 
        //'pay_sts' => 'required '
                          
    );
    //Custom Error Messages
    private $messages_booking = [
                    'book_date' => 'Please Choose the booking date',
                    'vendor_id' => 'Vendor id is required.',
                    'timeslot_id' => 'time-slot id is required.',
                    'time_slot' => 'time-slot name is required.',
                    'service_name' => 'Please select the service.',
                    'no_seat' => 'Please enter the number of seat you want to booking.',
                    //'customer_id' => 'Custommer id is required.',
                    'tot_cost' => 'total cost is required.',
                    //'pay_sts' => 'Pay status is required.'
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
            $ymd_bookdate = Date('Y-m-d',strtotime($request->book_date));$bk1 = new BookingSummery();
            $bk1->book_date = $ymd_bookdate;
            $bk1->vendor_id = $request->vendor_id;
            //$bk1->timeslot_id = $request->timeslot_id;
            //$bk1->time_slot = $request->time_slot;
           // $bk1->book_service = $request->service_name;
           // $bk1->no_seat = $request->no_seat;
            $bk1->customer_id = $request->customer_id;
            $bk1->tot_cost = $request->tot_cost;
            $bk1->pay_sts = $request->pay_sts;

            //Auto generate six digit confirm code
            $six_digit_random_number = mt_rand(100000, 999999);
            $bk1->confirm_code = $six_digit_random_number;
             if($bk1->save())
            {
                $arr_services = $request->arr_services;
                $arr_timeslot_id = $request->arr_timeslot_id;
                $arr_timeslot_name = $request->arr_timeslot_name;
                $arr_no_seat = $request->arr_no_seat;
                $arr_prices = $request->arr_prices;

                $c = 0;
                $len = sizeof($arr_services);
                for ($x = 0; $x < $len; $x++) {


                     $bk = new Booking();
                    $bk->book_date = $ymd_bookdate;
                    $bk->booking_summery_id = $bk1->id;
                    $bk->vendor_id = $request->vendor_id;
                    $bk->timeslot_id = $arr_timeslot_id[$x];
                    $bk->time_slot = $arr_timeslot_name[$x];
                    $bk->book_service = $arr_services[$x];
                    $bk->no_seat = $arr_no_seat[$x];
                    $bk->customer_id = $request->customer_id;
                    $bk->tot_cost = $arr_prices[$x];

                    if($bk->save())
                    {
                         $c++;
                    }
                } 
                if($c == $len)
                {
                    return response()->json(['status'=>1,'success'=>'Booking Successfull','booking_id'=>$bk->id]);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
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
        $xtp=\Session::get('user_type');
        if($xtp > 0)
        {
            $id = $xtp;
        }
          $book_list=false;
            $book_list =  BookingSummery::join('public_user','booking_summery.customer_id','=','public_user.id')
            ->where('booking_summery.vendor_id','=', $id)
            ->select('booking_summery.*', 'public_user.name','public_user.mobile')
            ->get();
           // dd($book_list);
            return view('mybookings',["bookings"=>$book_list]);
        
       
        //$vnd =  Vendor::where('is_trash',1)->get();
        //return view('mybookings')->with('vendors',$vnd);
    }
    //================================================================================
    //============================== Get BookingsDetails ===========================
    public function getBookDetails(Request $request)
    {
        $book_list =  Booking::where('booking_summery_id',$request->id)->get();
        $d = '';
        if( $book_list->isEmpty())
        {
            $d =$d.'<tr>
                        <td colspan="4">No Data Found</td>
                       
                    </tr>';
        }
        else
        {
            foreach($book_list as $bsk)
            {
                $d =$d.'<tr>
                        <td>'. $bsk->book_service.'</td>
                        <td>'.$bsk->time_slot.'</td>
                        <td>'.$bsk->no_seat.'</td>
                        <td>'.$bsk->tot_cost.'</td>
                        </tr>';
              
            }
        }

          
       return response()->json(['status'=>1,'success'=>$d]);
        //$vnd =  Vendor::where('is_trash',1)->get();
        //return view('mybookings')->with('vendors',$vnd);
    }
    /*
    *Method to get all bookings 
    */
    public function bookings(Request $request)
    {
       
        $book_list=false;
        $book_list =  BookingSummery::
        join('vendors','booking_summery.vendor_id','=','vendors.id')
        ->join('public_user','booking_summery.customer_id','=','public_user.id')
        ->select('booking_summery.*', 'vendors.shop_name','public_user.name','public_user.mobile')
        ->get();
        return view('bookings',["bookings"=>$book_list]);
       
    }
    // Show all booking of Custommer
     public function showAllBooking(Request $request)
    {
        $id=$request->auth->id;
        $book_list =  BookingSummery::join('vendors','booking_details.vendor_id','=','vendors.id')
        ->where('customer_id',$id)->where('pay_sts',1)->get();
        if($book_list){
            return response()->json(['status'=>1,'success'=>'Bookings fetching Successfull',
            'bookings'=>$book_list]);
        }else{
            return response()->json(['status'=>0,'success'=>'Bookings fetching failed']);
        }
       
    }
    
    // Show all booking of Custommer
     public function showSingleBooking($id)
    {
        $book_list =  BookingSummery::where('id',$id)->get();
        return response()->json($book_list);
       
    }
     //=============== Cancel Booking =========================================
    public function cancelBooking(Request $request)
    {
        if(BookingSummery::where('id',$request->id)->update(['track_sts' => 'CANCEL']))
        {

            if(Booking::where('booking_summery_id',$request->id)->update(['track_sts' => 'CANCEL']))
            {
                return response()->json(['status'=>1,'success'=>'Booking Cancelled.']);
            }
            else
            {
                return response()->json(['status'=>-1,'success'=>'InternalError']);
            } 
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
    //============================== Get Service catagory ===========================
    public function getCatagory()
    {
        
         $vnd =  ServiceCatagory::where('is_enable', '=', 1)->where('is_trash', '=', 0)->get();
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
    //=======================================================================================

   // Default query parameter : http://localhost/M-App/api/public-user/getListShop/Bhubaneswar/NO/NO/0/-1/-1
    public function getFilterList($city,$locality,$gender,$catagory_id,$min,$max)
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
        if(($min != -1 && $max != -1) || $catagory_id > 0)
        {
          
            $query->join('services','vendors.id','services.vendor_id');
            if($min != -1 && $max != -1)
            {
                $query->whereBetween('services.service_price', [$min, $max]);
            }
            if($catagory_id > 0)
            {
                $query->where('services.catagory_id', '=', $catagory_id) ;
            }
           
        }
        $data=$query->get();
        
        if(sizeof($data)>0)
        {
            $res=array("status"=>1,"message"=>"Booking data retrived successfully!","vendors"=>$data);
            return response()->json($res);
        }
        else
        {
            $res=array("status"=>0,"message"=>"No data found");
            return response()->json($res);
        }
      
    }
    public function makeHash(Request $request){
        $key=$request->key;
        $txnid=$request->txnid;
        $amount=$request->amount;
        $productinfo=$request->productinfo;
        $firstname=$request->firstname;
        $email=$request->email;
        $salt = "XXXXXX"; //Please change the value with the live salt for production environment
        
        $payhash_str = $key . '|' . $this->checkNull($txnid) . '|' . $this->checkNull($amount) . '|' . $this->checkNull($productinfo) . '|' . $this->checkNull($firstname) . '|' . $this->checkNull($email) . '|||||||||||' . $salt;
        
        $hash = strtolower(hash('sha512', $payhash_str));
        return response()->json($hash);
    }
    public function checkNull($value)
    {
        if ($value == null) {
            return '';
        } else {
            return $value;
        }
    }
    public function payuValidate(Request $request){
        $res=array("status"=>1,"message"=>"pay ment success");
        return response()->json($res);
    }
     //=============== Cancel Booking =========================================
    public function confirmBookCode(Request $request)
    {
        if(BookingSummery::where('id',$request->id)->where('confirm_code',$request->code)->update(['track_sts' => 'CONFIRM']))
        {
            if(Booking::where('booking_summery_id',$request->id)->update(['track_sts' => 'CONFIRM']))
            {
                return response()->json(['status'=>1,'success'=>'Booking Confirmed.']);
            }
            else
            {
                return response()->json(['status'=>-1,'success'=>'Invalid Code']);
            } 
        }
        else
        {
            return response()->json(['status'=>-1,'success'=>'Invalid Code']);
        } 
    }
     //=============== Cancel Booking =========================================
    public function getAllDetailsBooking($id)
    {
        $book_list =  Booking::where('booking_summery_id',$id)->get();
      
        if( $book_list->isEmpty())
        {
            $res=array("status"=>0,"message"=>"No data found","data"=>$book_list);
            return response()->json($res);
        }
        else
        {
             $res=array("status"=>1,"message"=>"Booking data retrived successfully!","data"=>$book_list);
            return response()->json($res);
        }
    }
    //=================== delete service booking ===============================================
    public function deleteSingleSlot($id)
    {
       
        if(Booking::where('id', $id)->delete())
        {
            return response()->json(['status'=>1,'success'=>'Status Changed Successfully']);
        }
        else
        {
            return response()->json(['status'=>-1,'success'=>'InternalError']);
        }
       
    }
}