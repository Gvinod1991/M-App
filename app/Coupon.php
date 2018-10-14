<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;



class Coupon extends Model
{
    //Table Name
    protected $table = 'coupons';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

     protected $fillable = array('coupon_code','coupon_name','price','from_date','to_date','is_enable','is_trash','created_at','updated_at');

      public function checkStatus($code)
	{
        $someVariable = strtoupper(trim($code));
        $hotel_user_data = DB::select( DB::raw("SELECT id,is_trash FROM coupons WHERE upper(coupon_code) = :somevariable "), array(
		'somevariable' => $someVariable,
	  ));

    //  dd($hotel_user_data);
		//$hotel_user_data = Country::where(DB::raw('upper(country_name)'),'=',strtoupper($name))->first(['id']);
		if($hotel_user_data)
		{
            $c = 5;
            foreach ($hotel_user_data as $tag) 
            {
                if($tag->is_trash==0)
                {
                    return "exist";
                }
                else
                {
                    return  $tag->id;
                    
                }
            }
            
            
			
		}
		else
		{
			return "new";
		}
	}

}
