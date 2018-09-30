<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class Blockservice extends Model
{
    //Table Name
    protected $table = 'service_block';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

    protected $fillable = array('block_date','vendor_id','service_id','remarks','is_trash','created_at','updated_at');

    
}
