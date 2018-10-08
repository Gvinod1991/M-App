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

class Foo { 
    public $aMemberVar = 'aMemberVar Member Variable'; 
    public $aFuncName = 'aMemberFunc'; 
    
    
    function aMemberFunc() { 
        print 'Inside `aMemberFunc()`'; 
    } 
} 

class DayBlockController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    
   public function showDailyEvents($id,$dt)
    {
         $xtp=\Session::get('user_type');
        if($xtp > 0)
        {
            $id = $xtp;
        }
        $alldata = array();
        $daily_blk=array();
        $service_blk=array();
        $time_blk=array();
        $seat_blk=array();
        $day_close =  Closerecord::where('vendor_id',$id)->where('close_date',$dt)->where('is_trash',0)->get();
        if($day_close->isEmpty())
        {
             $o = (object) ['tabid'=>0,'status' => 0,'message'=>'Open'];
             array_push($daily_blk,$o);

            //Service block logic part
            $avl_services =  Services::where('vendor_id',$id)->where('is_trash',0)->where('is_enable',1)->get();
            $block_serv =  Blockservice::where('block_date',$dt)->where('vendor_id',$id)->where('is_trash',0)->get();

            if($block_serv->isEmpty())
            {
                // If data Empty
                foreach($avl_services as $i)
                {
                    $o1 = (object) ['tabid'=>0,'status' =>0 ,'servname'=>$i->service_name,'servid' =>$i->id,'vndid' =>$id];
                    array_push($service_blk,$o1);
                }
                 
              
            }
            else
            {
                foreach($avl_services as $i)
                {
                    $t = 0;
                    foreach($block_serv as $ip)
                    {
                        if($i->id==$ip->service_id)
                        {
                           $t = 1;
                        }
                      
                    }
                    if($t == 1)
                    {
                        $o1 = (object) ['tabid'=>$ip->id,'status' =>1 ,'servname'=>$i->service_name,'servid' =>$i->id,'vndid' =>$id];
                        array_push($service_blk,$o1);
                    }
                    else
                    {
                        $o1 = (object) ['tabid'=>0,'status' =>0 ,'servname'=>$i->service_name,'servid' =>$i->id,'vndid' =>$id];
                        array_push($service_blk,$o1);
                    }
                    
                }

            }

            //Time Slot block logic part
            $avl_timeslot =  Timeslot::where('vendor_id',$id)->where('is_trash',0)->where('is_enable',1)->get();

            $block_ts =  Blocktimeslot::where('block_date',$dt)->where('vendor_id',$id)->where('is_trash',0)->get();

            if($block_ts->isEmpty())
            {
                // If data Empty
                foreach($avl_timeslot as $i)
                {
                    $o2 = (object) ['tabid'=>0,'status' =>0 ,'servname'=>$i->timing,'maxseat'=>$i->max_limit_booking,'servid' =>$i->id,'vndid' =>$id];
                    array_push($time_blk,$o2);
                }
                 
              
            }
            else
            {
                foreach($avl_timeslot as $i)
                {
                    $t = 0;
                    foreach($block_ts as $ip)
                    {
                       if($i->id==$ip->timeslot_id)
                       {
                           $t = 1;
                       }
                        
                    }
                    if($t == 1)
                    {
                        $o2 = (object) ['tabid'=>$ip->id,'status' =>1 ,'servname'=>$i->timing,'maxseat'=>$i->max_limit_booking,'servid' =>$i->id,'vndid' =>$id];
                        array_push($time_blk,$o2);
                    }
                    else
                    {
                        $o2 = (object) ['tabid'=>0,'status' =>0 ,'servname'=>$i->timing,'maxseat'=>$i->max_limit_booking,'servid' =>$i->id,'vndid' =>$id];
                        array_push($time_blk,$o2);
                    }
                    
                }

            }

            // SEAt BLOCk Part
             $block_seatt =  Blockseat::where('block_date',$dt)->where('vendor_id',$id)->where('is_trash',0)->get();
             if($block_seatt->isEmpty())
             {
                foreach($time_blk as $i)
                {
                    if($i->status == 0)
                    {
                        $o3 = (object) ['tabid'=>0,'servname'=>$i->servname,'avl'=>$i->maxseat,'blk'=>0,'servid' =>$i->servid,'vndid' =>$id];
                        array_push($seat_blk,$o3);
                    }
                    
                }
             }
             else
             {
                 foreach($time_blk as $i)
                {
                    if($i->status == 0)
                    {
                        $t=0;
                        $s = 0;
                        $tbid = 0;
                        foreach($block_seatt as $ix)
                        {
                             if($i->servid==$ix->timeslot_id)
                             {
                                 $t=1;
                                 $s =  $ix->no_seat;
                                 $tbid =$ix->id;
                             }
                        }
                         $o3 = (object) ['tabid'=>$tbid,'servname'=>$i->servname,'avl'=>$i->maxseat,'blk'=>$s,'servid' =>$i->servid,'vndid' =>$id];
                        array_push($seat_blk,$o3);

                        //if($i->servid==$ix->timeslot_id)
                        //{
                            
                           // $o3 = (object) ['tabid'=>$tbid,'servname'=>$i->servname,'avl'=>$i->maxseat,'blk'=>$s,'servid' =>$i->servid,'vndid' =>$id];
                           // array_push($seat_blk,$o3);
                       // }
                       // else
                       // {
                           // $o3 = (object) ['tabid'=>$tbid,'servname'=>$i->servname,'avl'=>$i->maxseat,'blk'=>$s,'servid' =>$i->servid,'vndid' =>$id];
                           // array_push($seat_blk,$o3);
                        //}
                        
                    }
                    
                }
             }
            
            
         }
        else
        {
             foreach($day_close as $i)
             {
                 $o = (object) ['tabid'=>$i->id,'status' => 1,'message'=>'Closed'];
                 array_push($daily_blk,$o);
             }
             
        }
        $alldata["dayblock"]= $daily_blk;
        $alldata["serblock"]= $service_blk;
        $alldata["timeslot"]= $time_blk;
        $alldata["seatbl"]= $seat_blk;
        //dd($alldata);
        //$ymd_d = DateTime::createFromFormat('d-m-Y',$dt)->format('Y-m-d');
        return view('dailyBlockStatus',["data"=>$alldata,'vendor_id'=>$id,'today'=>$dt]);
    }
    
    public function showCallender($id)
    {
       
       // Get day block data
       // $alldata = array();
       // $day_close =  Closerecord::where('vendor_id',$id)->where('is_trash',0)->get();
      //  $alldata["dayblock"]= $day_close;
      //  $timeslot_bk =  Blocktimeslot::where('vendor_id',$id)->where('is_trash',0)->get();
      //  $alldata["timeslot"]= $timeslot_bk;
      //  $seat_bk =  Blockseat::where('vendor_id',$id)->where('is_trash',0)->get();
      //  $alldata["seat"]= $seat_bk;
      //  $serv_bk =  Blockservice::where('vendor_id',$id)->where('is_trash',0)->get();
      //  $alldata["service"]= $serv_bk;
        
        
        
      // dd($alldata);
        return view('viewCallender',["data"=>$alldata]);
      //
    }

    // Change Status for day block
     public function changeStsDayBlock(Request $request)
     {
            if($request->bid==0)
            {
                 $serv = new Closerecord();
                $serv->close_date = $request->bdate;
                $serv->vendor_id = $request->vid;
                 if($serv->save())
                {
                        return response()->json(['status'=>1,'success'=>'Status Changed Successfully.']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
            else
            {
                if(Closerecord::where('id', $request->bid)->delete())
                {
                    return response()->json(['status'=>1,'success'=>'Status Changed Successfully']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
           
     }
     // Change Status for day block
     public function changeStsServiceBlock(Request $request)
     {
            if($request->bid==0)
            {
                 $serv = new Blockservice();
                $serv->block_date = $request->bdate;
                $serv->vendor_id = $request->vid;
                 $serv->service_id = $request->sid;
                 if($serv->save())
                {
                        return response()->json(['status'=>1,'success'=>'Status Changed Successfully.']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
            else
            {
                if(Blockservice::where('id', $request->bid)->delete())
                {
                    return response()->json(['status'=>1,'success'=>'Status Changed Successfully']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
           
     }
      // Change Status for day block
     public function changeStsTimeBlock(Request $request)
     {
            if($request->bid==0)
            {
                 $serv = new Blocktimeslot();
                $serv->block_date = $request->bdate;
                $serv->vendor_id = $request->vid;
                 $serv->timeslot_id = $request->sid;
                 if($serv->save())
                {
                        return response()->json(['status'=>1,'success'=>'Status Changed Successfully.']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
            else
            {
                if(Blocktimeslot::where('id', $request->bid)->delete())
                {
                    return response()->json(['status'=>1,'success'=>'Status Changed Successfully']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
           
     }

     // Seat block Unit
     public function seatBlock(Request $request)
     {
            if($request->blk > $request->avl)
            {
                return response()->json(['status'=>-1,'success'=>'You cant block the seat more than the availablity.']);
            }

            if($request->bid==0)
            {
                if($request->blk ==0)
                {
                    return response()->json(['status'=>-1,'success'=>'Please Enter a valid seat number for blocking .']);
                }
                 $serv = new Blockseat();
                 $serv->block_date = $request->bdate;
                 $serv->vendor_id = $request->vid;
                 $serv->timeslot_id = $request->sid;
                 $serv->no_seat = $request->blk;
                 $serv->remarks = 'No Remarks';
                 if($serv->save())
                {
                        return response()->json(['status'=>1,'success'=>'Status Changed Successfully.']);
                }
                else
                {
                    return response()->json(['status'=>-1,'success'=>'InternalError']);
                }
            }
            else
            {
                if($request->blk == 0)
                {
                    if(Blockseat::where('id', $request->bid)->delete())
                    {
                        return response()->json(['status'=>1,'success'=>'Status Changed Successfully']);
                    }
                    else
                    {
                        return response()->json(['status'=>-1,'success'=>'InternalError']);
                    }
                }
                else
                {
                    if(Blockseat::where('id',$request->bid)->update(['no_seat' => $request->blk]))
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


}