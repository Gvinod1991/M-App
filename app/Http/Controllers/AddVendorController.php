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


class AddVendorController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    private $rulest = array(
        'shop_name' => 'required ',
        'description' => 'required ',
        'gender' => 'required ',
        'owner_name' => 'required ',
        'email' => 'required | email',
        'state' => 'required ',
        'city' => 'required ',
        'locality' => 'required ',
        'addr' => 'required ',
        'contact' => 'required | digits:10'
       
    );
     private $messagest = [
                'shop_name.required' => 'The Shop Name field is required.',
                'description.required' => 'The description field is required.',
                'gender.required' => 'The gender field is required.',
               
                'owner_name.required' => 'The owner_name field is required.',
                'email.required' => 'Proper email address is required.',
                'state.required' => 'The state field is required.',
                'city.required' => 'The City field is required.',
                'locality.required' => 'The Locality field is required.',
                'addr.required' => 'The Address is required.',
                 'contact.required' => 'The contact number field is required.'
                   ];
    public $aid = 0; 
    public $state_list=array('Andhra Pradesh'=>'Andhra Pradesh',
    'Arunachal Pradesh'=>'Arunachal Pradesh',	
    'Assam' => 'Assam',
    'Bihar'	=> 'Bihar',
    'Chhattisgarh'	=> 'Chhattisgarh',
    'Goa'	=> 'Goa',
    'Gujarat'	=> 'Gujarat',
    'Haryana'	=> 'Haryana',	
    'Himachal Pradesh'	=> 'Himachal Pradesh',
    'Jammu and Kashmir'	=> 'Jammu and Kashmir',
    'Jharkhand'	=> 'Jharkhand',
    'Karnataka'	=> 'Karnataka',
    'Kerala'	=> 'Kerala',
    'Madhya Pradesh'	=> 'Madhya Pradesh',
    'Maharashtra'	=> 'Maharashtra',
    'Manipur' => 'Manipur',
    'Meghalaya' => 'Meghalaya',
    'Mizoram' => 'Mizoram',
    'Nagaland' => 'Nagaland',
    'Odisha' => 'Odisha',
    'Punjab' => 'Punjab',
    'Rajasthan' => 'Rajasthan',
    'Sikkim' => 'Sikkim',
    'Tamil Nadu' => 'Tamil Nadu',
    'Telangana' => 'Telangana',
    'Tripura' => 'Tripura',
    'Uttar Pradesh' => 'Uttar Pradesh',
    'Uttarakhand' => 'Uttarakhand',
    'West Bengal' => 'West Bengal');

    
    public function show()
    {
        $vnd =  Vendor::where('is_trash',1)->get();
        return view('vendorlist')->with('vendors',$vnd);
    }
    //Get Callender blocking Events
    
    public function showCallender($id)
    {
       $aid = $id; 
       // Get day block data
        $alldata = array();
        $day_close =  Closerecord::where('vendor_id',$id)->where('is_trash',0)->get();
        $alldata["dayblock"]= $day_close;
        $timeslot_bk =  Blocktimeslot::where('vendor_id',$id)->where('is_trash',0)->get();
        $alldata["timeslot"]= $timeslot_bk;
        $seat_bk =  Blockseat::where('vendor_id',$id)->where('is_trash',0)->get();
        $alldata["seat"]= $seat_bk;
        $serv_bk =  Blockservice::where('vendor_id',$id)->where('is_trash',0)->get();
        $alldata["service"]= $serv_bk;
        return view('viewCallender',["data"=>$alldata,'vendor_id'=>$id]);
    }
     // View daile event
    
    // New Vendor form load
    public function newVendor()
    {
        $vendor = new Vendor;
        return view('addNewVendor', ['vendor' => $vendor,'selected'=>'','statesList'=>$this->state_list,'selected_state'=>'']);
    }
    // New Vendor form load
    public function editVendor($id)
    {
        $vendor =  vendor::find($id);
        return view('addNewVendor', ['vendor' => $vendor,'selected'=>$vendor->gender,'statesList'=>$this->state_list,'selected_state'=>$vendor->state]);
    }
    // Add New Vendor
    public function saveVendor(Request $request)
    {
        $failure_message='Vendor registration failed';
        $validator = Validator::make($request->all(),$this->rulest,$this->messagest);
        if ($validator->fails())
        {
            \Session()->flash('errors', $validator->errors()->toArray());
            return redirect('/newVendor');
        }
        $data=$request->all();
        if(isset($data['id']) && (int)$data['id'] != 0){
            $vendor = Vendor::find($data['id']);
        }else{
            $vendor = new Vendor();
        }
        if($vendor->fill($data)->save())
        {
            $ws = new Weekshedule();
            $data1 = $ws->toArray();
            $data1['vendor_id']= $vendor->id;
             if($ws->fill($data1)->save())
             {
                $bnk = new Bankdetails();
                $data2 = $bnk->toArray();
                $data2['vendor_id']= $vendor->id;
                 if($bnk->fill($data2)->save())
                 {
                    \Session()->flash('flash_message', 'Vendor saved successfully!');
                    return redirect('/newVendor'); 
                 }
                  else
                {
                    \Session()->flash('error_message', 'Vendor saving failed!');
                    return redirect('/newVendor');
                }
                
             }
             else
            {
                \Session()->flash('error_message', 'Vendor saved failed!');
                    return redirect('/newVendor');
            }
            
        }
        else
        {
            $res=array('status'=>-1,"message"=>$failure_message);
            $res['errors'][] = "Internal server error";
            return response()->json($res);
        }
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
     //Profile uploading rules
    private $profile_rules = array(
        'logo.*' => 'mimes:jpeg,png,jpg,gif,svg|max:1024',
        
        );
     //Profile uploading rules
     private $service_image_rules = array(
        'file.*' => 'mimes:jpeg,png,jpg,gif,svg|max:1024',
        
        );
    //================================ Add Services ========================================================
    public function addServiceToDb(Request $request)
    {
        //dd($request->all());
        $data=$request->all();

        $failure_message='Error !';
        $validator = Validator::make($request->all(),$this->rules_addservice,$this->messages_addservice);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'success'=>$validator->errors()));
        }
        $serv = new Services();
        $serv->service_name = $request->service;
        $serv->service_price = $request->price;
        $serv->any_offer = $request->offer;
        $serv->vendor_id = $request->vid;
        

        if ($request->hasFile('file'))
        {
            $file = array('file' => $request->file('file'));
            $validator = Validator::make($file,$this->service_image_rules);
            if($validator->fails())
            {
                return response()->json(array('status'=>0,'message'=>$failure_message,'errors'=>$validator->errors()));
            }
        //Rename the uploaded file,To avoid name confusuion
        $new_name = time().$request->file('file')->getClientOriginalName(); // Image Rename
        $new_name=str_replace(' ','',$new_name);//Removeing space between  image name
        $service_image='uploads/services/'.$new_name; 
        if($request->file('file')->move(public_path('uploads/services'),$new_name)){
            $serv->service_image= $service_image;
        }
        }
           
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
    public function showAll()
    {
        $vnd =  Vendor::where('is_trash',1)->where('sts','Active')->get();
        if(!$vnd->isEmpty())
        {
             return response()->json($vnd);
        }
        else
        {
            $res=array('status'=>0,"message"=>"No data Found");
            return response()->json($res);
        }
       // return view('vendorlist')->with('vendors',$vnd);
     
    }
    // Get All Data by shop id
     public function showSingle($id)
    {
        $vnd =  Vendor::where('id',$id)->get();
        $serv =  Services::where('vendor_id',$id)->get();
        $timeslot =  Timeslot::where('vendor_id',$id)->get();
        $alldata = array();
        $alldata["vendors"]= $vnd;
        $alldata["service"]= $serv;
        $alldata["timeslot"]= $timeslot;
        if($vnd)
        {
             return response()->json($alldata);
        }
        else
        {
            $res=array('status'=>0,"message"=>"No data Found");
            return response()->json($res);
        }
       // return view('vendorlist')->with('vendors',$vnd);
     
    }
    //============== Upload Profile pic ===================
    public function uploadProfilePic(Request $request)
    {
        $failure_message="Profile picture uploading failed!";
       // dd($request->vid);
        if ($request->hasFile('logo'))
        {
            $file = array('logo' => $request->file('logo'));
            
            $validator = Validator::make($file,$this->profile_rules);
            if($validator->fails())
            {
                return response()->json(array('status'=>0,'message'=>$failure_message,'errors'=>$validator->errors()));
            }
            //Rename the uploaded file,To avoid name confusuion
            $new_name = time().$request->file('logo')->getClientOriginalName(); // Image Rename
            $new_name=str_replace(' ','',$new_name);//Removeing space between  image name
            $data['logo'] ='uploads/vendors/'.$new_name; 
            if($request->file('logo')->move(public_path('uploads/vendors'),$new_name))
            {
                 if(Vendor::where('id',$request->vid)->update(['photo' => $new_name]))
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
               return response()->json(['status'=>0,'success'=>'InternalError !']);
            }
            
        }
        else
        {
            return response()->json(['status'=>0,'success'=>'InternalError !']);
        }
       
    }
}