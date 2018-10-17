<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class Booking extends Model
{
    //Table Name
    protected $table = 'booking_details';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

    protected $fillable = array('book_date','booking_summery_id','vendor_id','timeslot_id','time_slot','book_service','no_seat','customer_id','tot_cost','track_sts','created_at','updated_at');

    
}
