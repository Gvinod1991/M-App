<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class Weekshedule extends Model
{
    //Table Name
    protected $table = 'weekly_shedule';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

    protected $fillable = array('sun','mon','tue','wed','thu','fri','sat','vendor_id','created_at','updated_at');

    
}
