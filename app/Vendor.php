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
    //Filable fields
    protected $fillable = array('shop_name','shop_descr','owner_name', 'addr','locality','city','state','shop_location','photo','contact','email','open_at','close_at','twiter_link','facebook_link','instagram_link','youtube_link','sts','is_trash','created_at','updated_at');
    //Protected fields 
    protected $hidden = ['password'];
}
