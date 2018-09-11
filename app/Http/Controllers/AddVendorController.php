<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Services;
use App\Timeslot;
use App\Bankdetails;
use App\Weekshedule;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facedes\input;
class AddVendorController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

    
    public function show()
    {
        $vnd =  Vendor::where('is_trash',1)->get();
        return view('vendorlist')->with('vendors',$vnd);
    }
    // New Vendor form load
     public function showVendorFomr()
    {
       
        return view('addNewVendor');
    }
    // Add New Vendor
    public function createNewVendor(Request $request)
    {
      

       Vendor::create($request->all());
       
    }
    // Show vendor profile
     public function showVendorProfile($id)
    {
        $vnd =  Vendor::where('id',$id)->get();
        $serv =  Services::where('vendor_id',$id)->where('is_trash', '=', 0)->get();
        $timeslot =  Timeslot::where('vendor_id',$id)->where('is_trash', '=', 0)->get();
        $bankdetails =  Bankdetails::where('vendor_id',$id)->get();
        $weekshedule =  Weekshedule::where('vendor_id',$id)->get();
        $alldata = array();
        $alldata["vendors"]= $vnd;
        $alldata["service"]= $serv;
        $alldata["timeslot"]= $timeslot;
        $alldata["bankdetails"]= $bankdetails;
        $alldata["week"]= $weekshedule;
        return view('vendorprofile',["data"=>$alldata]);
       // return view('vendorprofile')->with('vendors',$vnd);
       //return view('vendorprofile');
    }
    // Add new Service
    //validation rules
    private $rules_addservice = array(
        'service' => 'required ',
        'price' => 'required ',
        'offer' => 'required '         
    );
    //Custom Error Messages
    private $messages_addservice = [
                'service.required' => 'Service name is required.',
                    'price.required' => 'Price is required.',
                    'offer.required' => 'Offer price is required.',
                    ];
     private $rules_addtimeslot = array(
        'fromtime' => 'required ',
        'totime' => 'required ',
        'maxbook' => 'required '         
    );
    //Custom Error Messages
    private $messages_addtimeslot = [
                'fromtime.required' => 'From time is required.',
                    'totime.required' => 'To time is required.',
                    'maxbook.required' => 'Max booking limit is required.',
                    ];

     private $rules_bank = array(
        'acno' => 'required ',
        'holder' => 'required ',
        'bank' => 'required ',
        'branch' => 'required ',
        'ifsc' => 'required '
                
    );
    //Custom Error Messages
    private $messages_bank = [
                'acno.required' => 'Account number is required.',
                    'holder.required' => 'Account holder is required.',
                    'bank.required' => 'Bank name is required.',
                    'branch.required' => 'Branch name is required.',
                    'ifsc.required' => 'IFSC Code is required.',
                    ];
    //================================ Add Services ========================================================
    public function addServiceToDb(Request $request)
    {
       
        $failure_message='Error !';
        $validator = Validator::make($request->all(),$this->rules_addservice,$this->messages_addservice);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'success'=>$validator->errors()));
        }
        else
        {
            $serv = new Services();
            $serv->service_name = $request->service;
            $serv->service_price = $request->price;
            $serv->any_offer = $request->offer;
            $serv->vendor_id = $request->vid;

            $chkdata = $serv->checkStatus($request->service,$request->vid);

            if($chkdata=="new")
            {
                if($serv->save())
                {
                        return response()->json(['status'=>1,'success'=>'Data is successfully added']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
            else if($chkdata=="exist")
            {
                return response()->json(['status'=>-1,'success'=>'This Service already exist.']);
                
            }
            else
            {
                 if(Services::where('id',$chkdata)->update(['is_trash' => 0]))
                {
                    return response()->json(['status'=>1,'success'=>'Data is successfully added']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                } 
            }

           
        }
        
        
    }
    //================================================================================
        //================================ Add Time Slot ========================================================
    public function addTimeslotToDb(Request $request)
    {
       
        $failure_message='Error !';
        $validator = Validator::make($request->all(),$this->rules_addtimeslot,$this->messages_addtimeslot);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'success'=>$validator->errors()));
        }
        else
        {
            $tslot = $request->fromtime.'-'.$request->totime;
            $serv = new Timeslot();
            $serv->timing = $tslot;
            $serv->max_limit_booking = $request->maxbook;
            $serv->vendor_id = $request->vid;

            $chkdata = $serv->checkStatus($tslot,$request->vid);

            if($chkdata=="new")
            {
                if($serv->save())
                {
                        return response()->json(['status'=>1,'success'=>'Data is successfully added']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
            else if($chkdata=="exist")
            {
                return response()->json(['status'=>-1,'success'=>'This Time-Slot already exist.']);
                
            }
            else
            {
                 if(Timeslot::where('id',$chkdata)->update(['is_trash' => 0,'max_limit_booking'=>$request->maxbook]))
                {
                    return response()->json(['status'=>1,'success'=>'Data is successfully added']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                } 
            }

           
        }
        
        
    }
    //================================================================================
     //================================ Add Time Slot ========================================================
    public function updateBank(Request $request)
    {
       
        $failure_message='Error !';
        $validator = Validator::make($request->all(),$this->rules_bank,$this->messages_bank);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'success'=>$validator->errors()));
        }
        else
        {
            $foo = array('account_no' => $request->acno,'account_holder'=> $request->holder,
            'bank_name' => $request->bank,'branch_name' => $request->branch,'ifsc_code' => $request->ifsc);
            
         
           if(Bankdetails::where('id',$request->vid)->update($foo))
                {
                    return response()->json(['status'=>1,'success'=>'Bank Details is successfully added']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                } 

        }
        
        
    }
    //================================================================================
      //================================ Add Time Slot ========================================================
    public function updateBankdet(Request $request)
    {
       
        $failure_message='Error !';
        $validator = Validator::make($request->all(),$this->rules_bank,$this->messages_bank);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'success'=>$validator->errors()));
        }
        else
        {
            $foo = array('account_no' => $request->acno,'account_holder'=> $request->holder,
            'bank_name' => $request->bank,'branch_name' => $request->branch,'ifsc_code' => $request->ifsc);
            
         
           if(Bankdetails::where('id',$request->vid)->update($foo))
                {
                    return response()->json(['status'=>1,'success'=>'Bank Details is successfully added']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                } 

        }
        
        
    }
    //================================================================================
    //=============== Update Week Sts =========================================
    public function changeWeeksts(Request $request)
    {
        if(Weekshedule::where('id',$request->id)->update(['sun' => $request->sun,'mon'=>$request->mon,'tue'=>$request->tue,'wed'=>$request->wed,'thu'=>$request->thu,'fri'=>$request->fri,'sat'=>$request->sat]))
        {
            return response()->json(['status'=>1,'success'=>'Status Changed successfully.']);
        }
        else
        {
            return response()->json(['status'=>-1,'success'=>'InternalError']);
        } 
    }

    //=============== For Change Status =========================================
    public function changeSts(Request $request)
    {
        if($request->trig=="0")
        {
           
            if(Vendor::where('id',$request->id)->update(['sts' => $request->sts]))
            {
                return response()->json(['status'=>1,'success'=>'Status successfully changed']);
            }
            else
            {
                return response()->json(['status'=>0,'success'=>'InternalError !']);
            }
        }
        if($request->trig =="1")
        {

            $foo = array();
            if($request->type == 'trash')
            {
                $foo = array('is_trash' => $request->sts);
            }
            else
            {
                $foo = array('is_enable' => $request->sts);
            }
            if(Services::where('id',$request->id)->update($foo))
            {
                return response()->json(['status'=>1,'success'=>'Status successfully changed']);
            }
            else
            {
                return response()->json(['status'=>0,'success'=>'InternalError !']);
            }
        }
        else
        {
            $foo = array();
            if($request->type == 'trash')
            {
                $foo = array('is_trash' => $request->sts);
            }
            else
            {
                $foo = array('is_enable' => $request->sts);
            }
            if(Timeslot::where('id',$request->id)->update($foo))
            {
                return response()->json(['status'=>1,'success'=>'Status successfully changed']);
            }
            else
            {
                return response()->json(['status'=>0,'success'=>'InternalError !']);
            }
        }

     
    }
//========================FOR API USE ===============================================
     //FOr API
    public function showAll(Request $request)
    {
        $vnd =  Vendor::where('is_trash',1)->get();
        if($vnd)
        {
            $res=array('status'=>1,"message"=>"No data Found",'vendors'=>$vnd);
            return response()->json($res);
        }
        else
        {
            $res=array('status'=>0,"message"=>"No data Found");
            return response()->json($res);
        }
    }
    // Get All Data by shop id
     public function showSingle($id,Request $request)
    {
        $vnd =  Vendor::where('id',$id)->first();
        $serv =  Services::where('vendor_id',$id)->get();
        $timeslot =  Timeslot::where('vendor_id',$id)->get();
        $alldata = array();
        $alldata["vendor"]= $vnd;
        $alldata["service"]= $serv;
        $alldata["timeslot"]= $timeslot;
        if($vnd)
        {
            $res=array('status'=>1,"message"=>"Vendor details fetched successfully !",'vendorData'=>$alldata);
            return response()->json($res);
        }
        else
        {
            $res=array('status'=>0,"message"=>"No data Found");
            return response()->json($res);
        }
       // return view('vendorlist')->with('vendors',$vnd);
     
    }
}