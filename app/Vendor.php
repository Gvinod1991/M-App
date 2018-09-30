<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //Table Name
    protected $table = 'vendors';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

     protected $fillable = array('shop_name','owner_name','description','gender',  'addr','locality','city','state','shop_location','photo','contact','email','open_at','close_at','twiter_link','facebook_link','instagram_link','youtube_link','sts','is_trash','created_at','updated_at');
}
