<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class Blocktimeslot extends Model
{
    //Table Name
    protected $table = 'timeslot_block';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

    protected $fillable = array('block_date','vendor_id','timeslot_id','no_seat','remarks','is_trash','created_at','updated_at');

    
}
