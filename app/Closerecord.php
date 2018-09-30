<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class Closerecord extends Model
{
    //Table Name
    protected $table = 'close_record';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

    protected $fillable = array('close_date','vendor_id','is_trash','remarks','created_at','updated_at');

    
}
