<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class Bankdetails extends Model
{
    //Table Name
    protected $table = 'bank_details';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

    protected $fillable = array('account_no','account_holder','bank_name','branch_name','ifsc_code','vendor_id','created_at','updated_at');

    
}
