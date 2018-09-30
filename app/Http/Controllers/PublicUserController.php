<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\PublicUser;
use DB;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
class PublicUserController extends Controller
{
    //validation rules
    private $rules = array(
        'mobile' => 'required | digits:10',
    );
    //Custom Error Messages
    private $messages = [
                'mobile.required' => 'The mobile number field is required.',
                   ];
    //validation rules
    private $update_rules = array(
        'email_id' => 'required | email',
        'name' => 'required',
        'location' => 'required',
    );
    //Custom Error Messages
    private $update_messages = [
                'email_id.required' => 'Email id field is required.',
                'name.required' => 'Your name is required.',
                'location.required' => 'Your address/location is required.'
                    ];
    //Profile uploading rules
    private $profile_rules = array(
        'profileFile.*' => 'mimes:jpeg,png,jpg,gif,svg|max:1024',
        
        )  ;
     /**
     * Create a new token.
     * 
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt($mobile,$exptime,$scope,$type) {
        $xsrftoken = md5(uniqid(rand(), true));
        $payload = [
            'iss' => env('APP_DOMAIN'), // Issuer of the token
            'sub' => $mobile, // Subject of the token
            'type'=> $type, // User Type 
            'iat' => time(), // Time when JWT was issued. 
            'exp' => $exptime, // Expiration time
            'scope'=>$scope,
            'xsrfToken' => $xsrftoken,
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    } 
    /**
     * Public User Registration
     * Create a new public user.
     *
     * @return public user registration status
    **/
    public function register(Request $request)
    {
        $user = new PublicUser();
        $failure_message='Account creation failed';
        $validator = Validator::make($request->all(),$this->rules,$this->messages);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'message'=>$failure_message,'errors'=>$validator->errors()));
        }
        $data=$request->all();

        //Get company id
        if($user->checkStatus($data['mobile'])=="new")
        {
            $resp="";
            DB::beginTransaction();
            if($user->fill($data)->save())
            {    
                DB::commit();
                $resp=$this->sendOtp($data['mobile']);
                if($resp['status']===1)
                {
                    $updated=DB::table('public_user')
                    ->where('id', $user->id)
                    ->update(['otp_session_key' => $resp['otp_session_key']]);
                    $res=array('status'=>1,"message"=>"Account creation successfull",
                    'data'=>array("status"=>"new","otp_session_key"=>$resp['otp_session_key']));
                    return response()->json($res);
                }
                else
                {
                    $res=array('status'=>0,"message"=>$failure_message);
                    $res['errors'][] = "Otp sendig failed";
                    return response()->json($res);
                }
               
            }
            else
            {
                $res=array('status'=>-1,"message"=>$failure_message);
                $res['errors'][] = "Internal server error";
                return response()->json($res);
            }
        }
        else if($user->checkStatus($data['mobile'])=="exist")
        {
            $exp_time = strtotime("+1000 day");//Expirition time
            $tp = env('PUBLIC_USER');
            $scope=['login'];
            $token = $this->jwt($data['mobile'],$exp_time,$scope,$tp);
            $res['status']="1";
            $res['message']='Account creation successfull';
            $res['data']=array('status'=>'active','auth_token'=>$token);
            return response()->json($res);     
        }
        else//unexpected failure
        {
            $res=array('status'=>-1,"message"=>$failure_message);
            $res['errors'][] = "Internal server error";
            return response()->json($res);
        }
            
    }
    /**
     * Public User Activation
     * Activates the public users.
     * @return hotel user activation status
    **/
    public function activateUser(Request $request)
    {
        $data=$request->all();
        $user_data=false;
        $user_data = PublicUser::where('otp_session_key', '=', $data['otp_session_key'])->first(['mobile', 'id']);
        $exp_time = strtotime("+1000 day");//Expirition time
        $tp = env('PUBLIC_USER');
        $scope=['login'];
        if($user_data)
        {
            $resp=$this->checkOtp($data['otp'],$data['otp_session_key']);
            if($resp['matched']=='OTP Matched')
            {
                $updated=PublicUser::
                where('id', $user_data['id'])
                ->update(['status' => 1]);
                if($updated)
                {
                    $token = $this->jwt($user_data->mobile,$exp_time,$scope,$tp);
                    $res['status']="1";
                    $res['message']='Successfully activated account';
                    $res['auth_token']=$token;
                    return response()->json($res);
                }
                else
                {
                    $res=array('status'=>-1,"message"=>"Internal server error.");
                    return response()->json($res);
                }
            }
            else
            {
                $res=array('status'=>0,"message"=>"Otp not matched,Try once again or click resend OTP!");
                return response()->json($res);
            }
            
        }
        else
        {
            $res=array('status'=>-1,"message"=>"Failed to activate account");
            $res['errors'][]="Invalid otp token";
            return response()->json($res);
        }
    }
    /**
     * Get User Details
     * Method to get the user details by id
     * @return public user details
    **/
    public function getUserDetails(Request $request)
    {
        $public_user_id=$request->auth->id;
        $public_user=false;
        $public_user = PublicUser::where('id',$public_user_id)->select('mobile','email_id','name','status','profile','location')->first();
        if($public_user)
        {
        
            $res=array('status'=>1,"message"=>"User details fetched successfully!",'public_user'=>$public_user);
            return response()->json($res);
            
        }
        else
        {
            $res=array('status'=>0,"message"=>"User details fetching failed");
            $res['errors'][]="Invalid auth token";
            return response()->json($res);
        }
    }
    /**
     * Public User Activation
     * Activates the public users.
     * @return hotel user activation status
    **/
    public function updatePublicUser(Request $request)
    {
        $data=$request->all();
        $failure_message='Failed to update user details';
        $validator = Validator::make($request->all(),$this->update_rules,$this->update_messages);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'message'=>$failure_message,'errors'=>$validator->errors()));
        }
        $public_user_id=$request->auth->id;
        $public_user = PublicUser::where('id',$public_user_id)->first();
        if($public_user)
        {
            if($public_user->fill($data)->save())
            {
                    $res['status']="1";
                    $res['message']='Successfully updated user details';
                    return response()->json($res);
            }
            else
            {
                $res=array('status'=>0,"message"=>$failure_message);
                $res['errors'][]="Internal server error";
                return response()->json($res);
            }
            
        }
        else
        {
            $res=array('status'=>-1,"message"=>$failure_message);
            $res['errors'][]="Invalid auth token";
            return response()->json($res);
        }
    }
    /**
     * Method to upload the profile picture
     * 
     */
    public function uploadPhoto(Request $request)
    {
        //Get the user id From token
        $public_user_id=0;
        if(isset($request->auth->id))
        {
            $public_user_id=$request->auth->id;
        }
        if($public_user_id==0)
        {
            $res=array('status'=>-1,"message"=>'Invalid token provided,Please try to login and try once again!');
            $res['errors'][]="Invalid auth token";
            return response()->json($res); 
        }
        $failure_message="Profile picture uploading failed!";
        if ($request->hasFile('profileFile'))
        {
            // Make Validation
            $file = array('profileFile' => $request->file('profileFile'));
            $validator = Validator::make($file,$this->profile_rules);
            if($validator->fails())
            {
                return response()->json(array('status'=>0,'message'=>$failure_message,'errors'=>$validator->errors()));
            }
            //Rename the uploaded file,To avoid name confusuion
            $new_name = time().$request->file('profileFile')->getClientOriginalName(); // Image Rename
            $new_name=str_replace(' ','',$new_name);//Removeing space between  image name
            $data['profile'] ='uploads/'.$new_name; 
            // Move Images
            if($request->file('profileFile')->move(public_path('uploads'),$new_name))
            {
                $public_user = PublicUser::where('id',$public_user_id)->first();
                if($public_user)
                {
                    if($public_user->fill($data)->save())
                    {
                        $res['status']=1;
                        $res['message']='Successfully updated user\'s profile picture';
                        return response()->json($res);
                    }
                    else
                    {
                        $res=array('status'=>0,"message"=>$failure_message);
                        $res['errors'][]="Internal server error";
                        return response()->json($res);
                    }
                    
                }
            }
            else
            {
                $res=array('status'=>0,"message"=>$failure_message);
                $res['errors'][] = "Profile file moving failed";
                return response()->json($res);
            }
        }
        else
        {
            $res=array('status'=>0,"message"=>"Choose file to upload as profile picture",);
            return response()->json($res);
        }
    }
    /**
     * Method to get all the oublic users
     * @return list of public user
    **/
    public function customerList(Request $request)
    {
        $public_users=false;
        $public_users = PublicUser::where('status',1)->select('mobile','email_id','name','status','profile','location')->get();
        return view('customerList',["users"=>$public_users]);
    }
    /**
     * Method to Send OTP to respective phone number
     * @return OTP sent success or failed status
    **/
    public function sendOtp($phone_number)
    {
        $resp=$this->checkOtpBalance();
        $count=0;
        $res=array();
        if($resp['Status']=='Success')
        {
            $count=$resp['Details'];
        }
        if($count>0)
        {
        $api_key=env('SMS_API_KEY');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://2factor.in/API/V1/$api_key/SMS/$phone_number/AUTOGEN");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        $result=json_decode($result,true);
        if($result['Status']=='Success')
        {
            $res['status']=1;
            $res['otp_session_key']=$result['Details'];
            return $res; 
        }
        else
        {
            $res['status']=0;
            return $res;
        }
        }
        else
        {
            $res['status']=0;
            return $res;
        }
    }
    /**
     * Method to check OTP credit balance
     * @return OTP balance sent success or failed status
    **/
    public function checkOtpBalance()
    {
        $api_key=env('SMS_API_KEY');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://2factor.in/API/V1/$api_key/BAL/SMS");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
       
        $result= json_decode($result, true);
        return $result;
    }
    /**
     * Method to check OTP recived from user
     * @return OTP checked 'success' or 'failed' status
    **/
    public function checkOtp($otp,$otp_session_key)
    {
        
        $api_key=env('SMS_API_KEY');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://2factor.in/API/V1/$api_key/SMS/VERIFY/$otp_session_key/$otp");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        $result=json_decode($result,true);
        if($result['Status']=='Success')
        {
            $res['status']=1;
            $res['matched']=$result['Details'];
            return $res; 
        }
        else
        {
            $res['status']=0;
            $res['matched']=$result['Details'];
            return $res;
        }
    }
}
