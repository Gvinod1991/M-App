<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class Services extends Model
{
    //Table Name
    protected $table = 'services';
    
    //Primary Key
    public $primaryKey = 'id';

    //Time Stamps
    public $timestamps = true;

     protected $fillable = array('service_name','service_price', 'any_offer','vendor_id','is_enable','is_trash','created_at','updated_at');

     //Check existance of data having same fields
	//@auther : Shankar Bag
    public function checkStatus($name,$vid)
	{
        $someVariable = strtoupper(trim($name));
        $hotel_user_data = DB::select( DB::raw("SELECT id,is_trash FROM services WHERE upper(service_name) = :somevariable AND vendor_id = :vid"), array(
		'somevariable' => $someVariable,'vid'=>$vid,
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
