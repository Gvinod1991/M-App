<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facedes\input;
use Validator;
use App\PublicUser;
use App\BookingDetail;
use App\Vendor;
use App\Services;
use App\Timeslot;
use App\Bankdetails;
use App\Weekshedule;
use App\Closerecord;
use Datetime;
use Carbon;

class BookingController extends Controller{
//Validation rule for the bookSeat fucntion
private $rules = array(
    'book_date' => 'required ',
    'time_slot' => 'required',
    'vendor_id' => 'required',
    'book_service'=>'required',
    'no_seat'=>'required',
    'tot_cost' => 'required'
);
//Custom Error Messages
private $messages = [
            'book_date.required' => 'Service booking date is required.',
            'time_slot.required' => 'Service booking time slot is required.',
            'vendor_id.required' => 'Vendor is required.',
            'no_of_seats.required' => 'No of seats is required.',
            'paid_amount' =>'Booking amount is required'
                ];

//function to save the user bookings
public function bookSeat(Request $request){
        $bookings = new BookingDetail();
        $public_user_id=$request->auth->id;
        $failure_message='Booking failed due to some invalid data';
        $validator = Validator::make($request->all(),$this->rules,$this->messages);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'message'=>$failure_message,'errors'=>$validator->errors()));
        }
        $data=$request->all();
        $data['customer_id']=$public_user_id;
        $data['pay_sts']=1;
        $data['track_sts']=0;
        if($bookings->fill($data)->save()){
            return response()->json(array('status'=>1 ,'message'=>"You booking confirmed successfully!"));
        }else{
            return response()->json(array('status'=>0,'message'=>$failure_message)); 
        } 
}
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
                $res=array('status'=>1,"message"=>"Got Record");
                return response()->json($avl_timeslot);
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
    }

}