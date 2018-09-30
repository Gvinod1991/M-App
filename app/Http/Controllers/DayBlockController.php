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
                    foreach($block_serv as $ip)
                    {
                        if($i->id==$ip->service_id)
                        {
                            $o1 = (object) ['tabid'=>$ip->id,'status' =>1 ,'servname'=>$i->service_name,'servid' =>$i->id,'vndid' =>$id];
                            array_push($service_blk,$o1);
                        }
                        else
                        {
                            $o1 = (object) ['tabid'=>$ip->id,'status' =>0 ,'servname'=>$i->service_name,'servid' =>$i->id,'vndid' =>$id];
                            array_push($service_blk,$o1);
                        }
                        
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
                    foreach($block_ts as $ip)
                    {
                        if($i->id==$ip->timeslot_id)
                        {
                            $o2 = (object) ['tabid'=>$ip->id,'status' =>1 ,'servname'=>$i->timing,'maxseat'=>$i->max_limit_booking,'servid' =>$i->id,'vndid' =>$id];
                            array_push($time_blk,$o2);
                        }
                        else
                        {
                            $o2 = (object) ['tabid'=>$ip->id,'status' =>0 ,'servname'=>$i->timing,'maxseat'=>$i->max_limit_booking,'servid' =>$i->id,'vndid' =>$id];
                            array_push($time_blk,$o2);
                        }
                        
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
                        foreach($block_seatt as $ix)
                        {
                            if($i->servid==$ix->timeslot_id)
                            {
                                $s =  $ix->no_seat;
                                $o3 = (object) ['tabid'=>0,'servname'=>$i->servname,'avl'=>$i->maxseat,'blk'=>$s,'servid' =>$i->servid,'vndid' =>$id];
                                array_push($seat_blk,$o3);
                            }
                            else
                            {
                                $o3 = (object) ['tabid'=>0,'servname'=>$i->servname,'avl'=>$i->maxseat,'blk'=>0,'servid' =>$i->servid,'vndid' =>$id];
                                array_push($seat_blk,$o3);
                            }
                        }
                        
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
        return view('dailyBlockStatus',["data"=>$alldata,'vendor_id'=>$id]);
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
  


}