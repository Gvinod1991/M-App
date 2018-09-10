<?php
namespace App;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
class PublicUser extends Model
{
   
	protected $table = 'public_user';
    protected $primaryKey = "id";
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = array('mobile','email_id','name','status','profile','location');
	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
	/*
    *Account verifcation link will be fired to email account of the user by this function
	*@param $email for user email
	*@param $template is the email template
    *@param $subject for email subject
    *@param $verifyCode is the Verification link
    */
	public function sendMail($email,$template, $subject, $pass_code) 
	{
		$data = array('email' =>$email,'subject'=>$subject);
		Mail::send(['html' => $template], ['pass_code'=>$pass_code],function ($message) use ($data)
		{
			$message->to($data['email'])->from( env("MAIL_FROM"), env("MAIL_FROM_NAME"))->subject( $data['subject']);
		});	
		if(Mail::failures())
		{
			return false;
		}	
       	return true;    
	}
	
	/*
    *Check status of the hotel user
	*@param $email for user email
	*
	*@return hotel user  status
    */
	public function checkStatus($mobile)
	{
		$public_user = PublicUser::where('mobile', $mobile)->where('status',1)->first(['status', 'id']);
		if($public_user)
		{	
		 return "exist";
		}
		else
		{
			return "new";
		}
	}
	/*
	*@auther : Shankar Bag
    *Check the Availibility of Users
	*@param $email for user email

	*@return  count
    */
	public function checkEmailDuplicacy($email,$company_id)
	{
		$email = strtoupper(trim($email));
		$user_data=User::where(DB::raw('upper(email_id)'),$email)->where('is_trash' ,0)->where('company_id',$company_id)->first();
		if($user_data)
		{
			if($user_data->status==1)
			{
				return "exist";
			}
			else
			{
				return "pending";
			}
		}
		else
		{
			return 'new';
		}
	}
}