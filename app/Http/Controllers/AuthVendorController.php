<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Vendor;
use DB;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
class AuthVendorController extends Controller
{
    //validation rules
    private $rules = array(
        'email' => 'required | email',
        'password' => 'required',
    );
    //Custom Error Messages
    private $messages = [
                'email.required' => 'Email id  is required.',
                'email.email' => 'Email id should be valid.',
                'password.required' => 'Password is required.',
    ];
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
     * Vendor User Login
     * @return public user auth status
    **/
    public function Login(Request $request)
    {
        $user = new Vendor();
        $failure_message='Account creation failed';
        $validator = Validator::make($request->all(),$this->rules,$this->messages);
        if ($validator->fails())
        {
            return response()->json(array('status'=>0,'message'=>$failure_message,'errors'=>$validator->errors()));
        }
        $data=$request->all();
        if($user->checkEmailDuplicacy($request->input('email'))=='Exist')
        {
            $user = Vendor::where('email', $request->input('email'))->first();
            if($user)
            {
                $exp_time = strtotime("+1 day");//Expirition time
                $tp = $user->role_id;
                $scope=['login'];
                if (Hash::check($request->input('password'), $user->password)) {
                    $token = $this->jwt($user->username,$exp_time,$scope,$tp,0);
                                $res['status']="1";
                                $res['message']='User authentication successful';
                                $res['auth_token']=$token;
                                return response()->json($res);
                }else{
                    $res=array('status'=>-1,"message"=>$failure_message);
                    $res['errors'][] = "No User found";
                    return response()->json($res);
                }
            }
        }
        else{
            $res=array('status'=>-1,"message"=>$failure_message);
            $res['errors'][] = "Email already exists";
            return response()->json($res);
        }
            
    }
    /**
     * Get vendor User Details
     * Method to get the vendor user details by id
     * @return vendor user vendor details
    **/
    public function getUserDetails(Request $request)
    {
        $vendor_user_id=$request->auth->id;
        $vendor_user=false;
        $vendor_user = Vendor::where('id',$vendor_user_id)->select('contact','email','owner_name','photo')->first();
        if($vendor_user)
        {
        
            $res=array('status'=>1,"message"=>"User details fetched successfully!",'vendor'=>$public_user);
            return response()->json($res);
            
        }
        else
        {
            $res=array('status'=>0,"message"=>"User details fetching failed");
            $res['errors'][]="Invalid auth token";
            return response()->json($res);
        }
    }
    
  
   
}
