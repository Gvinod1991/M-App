<?php
namespace App;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
class BookingDetail extends Model
{
   
	protected $table = 'booking_details';
    protected $primaryKey = "id";
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = array('book_date','vendor_id','time_slot','book_service','no_seat','customer_id','tot_cost','pay_sts','track_sts');
	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
	
}