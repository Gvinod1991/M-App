<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class ServiceCatagory extends Model
{
    //Table Name
    protected $table = 'service_catagory';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

    protected $fillable = array('catagory_name','image_link','is_enable','is_trash','created_at','updated_at');

    
}
