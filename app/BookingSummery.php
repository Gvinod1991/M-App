<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class BookingSummery extends Model
{
    //Table Name
    protected $table = 'booking_summery';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

    protected $fillable = array('book_date','vendor_id','customer_id','tot_cost','pay_sts','track_sts','confirm_code','created_at','updated_at');

    
}
