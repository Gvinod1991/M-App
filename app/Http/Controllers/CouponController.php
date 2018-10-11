<?php

namespace App\Http\Controllers;
use App\Vendor;
use App\User;
use App\Services;
use App\Timeslot;
use App\Bankdetails;
use App\Weekshedule;
use App\Closerecord;
use App\Blockseat;
use App\Booking;
use App\Blocktimeslot;
use App\Blockservice;
use App\Coupon;
use Validator;
use Datetime;
use Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facedes\input;


class CouponController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
   private $rulest = array(
        'code' => 'required ',
        'name' => 'required ',
       
        'price' => 'required ',
        'fdt' => 'required ',
        'tdt' => 'required '
      );
     private $messagest = [
                 'code.required' => 'The Coupon code field is required.',
                'name.required' => 'The Coupon Name field is required.',
               
                'price.required' => 'The Coupon price field is required.',
                'fdt.required' => 'The Start Date field is required.',
                'tdt.required' => 'The End Date field is required.'
             
                   ];
    public function addNewCp(Request $request)
    {
       
        $failure_message='Error !';
        $validator = Validator::make($request->all(),$this->rulest,$this->messagest);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'success'=>$validator->errors()));
        }
        $d1 = DateTime::createFromFormat('d-m-Y',$request->fdt)->format('Y-m-d');
        $d2 = DateTime::createFromFormat('d-m-Y',$request->tdt)->format('Y-m-d');
        if($request->id == 0)
        {
            
            $request->fdt = $d1;
            $request->tdt = $d2;
            $serv = new Coupon();
            $serv->coupon_code = $request->code;
            $serv->coupon_name = $request->name;
            $serv->price = $request->price;
            $serv->from_date = $request->fdt;
            $serv->to_date = $request->tdt;
           

            $chkdata = $serv->checkStatus($serv->coupon_code);

            if($chkdata=="new")
            {
                if($serv->save())
                {
                        return response()->json(['status'=>1,'success'=>'New coupon added successfully. ']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
            else if($chkdata=="exist")
            {
                return response()->json(['status'=>-1,'success'=>'This coupon already exist.']);
                
            }
            else
            {
                if(Coupon::where('id',$chkdata)->update(['is_trash' => 0,'coupon_code'=>$request->code,'coupon_name'=>$request->name,'price'=>$request->price,'from_date'=>$d1,'to_date'=>$d2]))
                {
                    return response()->json(['status'=>1,'success'=>'New coupon added successfully.']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                } 
            }
        }
        else
        {
            if(Coupon::where('id',$request->id)->update(['coupon_code'=>$request->code,'coupon_name'=>$request->name,'price'=>$request->price,'from_date'=>$d1,'to_date'=>$d2]))
                {
                    return response()->json(['status'=>1,'success'=>'New coupon updated successfully.']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                } 
        }

    }
    public function show()
    {
        $vnd =  Coupon::where('is_trash',0)->get();
        return view('coupons')->with('vendors',$vnd);
    }
    //=============== Update Coupon Sts =========================================
    public function changeCpsts(Request $request)
    {
        $s = 0;
        if($request->sts == 0)
        {
             $s = 1;
        }
        if(Coupon::where('id',$request->id)->update(['is_enable' =>$s]))
        {
            return response()->json(['status'=>1,'success'=>'Status Changed successfully.']);
        }
        else
        {
            return response()->json(['status'=>-1,'success'=>'InternalError']);
        } 
    }
     //=============== Delete Coupon =========================================
    public function delCpsts(Request $request)
    {
       
        if(Coupon::where('id',$request->id)->update(['is_trash' =>1]))
        {
            return response()->json(['status'=>1,'success'=>'Deleted successfully.']);
        }
        else
        {
            return response()->json(['status'=>-1,'success'=>'InternalError']);
        } 
    }

    //==================PUBLIC API ====================================================
    //=============== Get All Available Coupon =========================================
    public function showAllValidCoupons(Request $request)
    {
         $dt = Carbon\Carbon::now();
         $vnd =  Coupon::where('is_trash',0)->where('is_enable',1)->whereDate('from_date', '<=', $dt)->whereDate('to_date', '>=', $dt)->get();
        if(!$vnd->isEmpty())
        {
             return response()->json($vnd);
        }
        else
        {
            $res=array('status'=>0,"message"=>"No Coupon Found");
            return response()->json($res);
        }
    }
    //=============== Check coupon code and return if valid =========================================
    public function getCouponbyCode($code)
    {
         $dt = Carbon\Carbon::now();
         $vnd =  Coupon::where('is_trash',0)->where('coupon_code',$code)->where('is_enable',1)->whereDate('from_date', '<=', $dt)->whereDate('to_date', '>=', $dt)->get();
        if(!$vnd->isEmpty())
        {
             return response()->json($vnd);
        }
        else
        {
            $res=array('status'=>0,"message"=>"Invalid Coupon OR Expired Coupon");
            return response()->json($res);
        }
    }
 
}