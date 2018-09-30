<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /* Login get post methods */
    protected function Login() {
        return View('login');
    }
     public function Authenticate(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
           // Authentication passed...
            $data = User::whereEmail($request->only('email'))->first();
            
            \Session::put('user_id', $data->id);
           
            \Session::put('email', $data->email);
            
            return redirect()->intended('/index');
        }
          return redirect('/')->withErrors([
            'email' => 'The email or the password is invalid. Please try again.',
        ]);
    }
     public function update(Request $request)
    {
        // Validate the new password length...

       echo Hash::make('admin#123');
      
    }
    /*
    *View page of settings 
    */
    public function settings(Request $request)
    {
        return view('changePassword');
    }
    /*
    *Update the password from settings form
    */
    public function update_settings(Request $request)
    {
        $id=\Session::get('user_id');
        $user= User::find($id);
        //return view('changePassword'); 
        if($request->input('password')!= $request->input('confirm-password'))
        {
           \Session()->flash('error_message', 'Password didn\'t matched,Try again !'); 
           return redirect('/settings'); 
        }
        else if($user->password == bcrypt($request->input('password')))
        {
           \Session()->flash('error_message', 'Please enter new password !'); 
           return redirect('/settings'); 
           
        }
        else
        {
            //  $user->passowrd=bcrypt($request->input('password'));
            $data['password']=bcrypt($request->input('password'));
            if($user->fill($data)->save()){
              \Session()->flash('flash_message', 'Password updated  successfully!');
              return redirect('/settings'); 
            }
            else{
              \Session()->flash('error_message', 'Invalid request, please try again!');
              return redirect('/settings'); 
                }
        } 
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
        }
}
