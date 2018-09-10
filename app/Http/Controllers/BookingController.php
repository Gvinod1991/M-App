<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\PublicUser;
use App\BookingDetail;
use DB;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
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

}