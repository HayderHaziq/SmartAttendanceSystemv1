<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 
use Carbon\Carbon;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function forgotpass()
    {
    return view('Auth.forgotpass');
    }

    public function respass(Request $request)
    {
    $email = $request->input('email');

    $getuser = User::where('email',$email)->first();

    $token = Str::random(100);

    $expirydate = Carbon::now()->addHour(1);

    $url = request()->getSchemeAndHttpHost().'/resetpassword'.'/'.$token;

    if($getuser == ''){
        return redirect()->back()->with('error', 'Invalid Email, Please try again!');
    }
    else{
        $getuser->reset_password_token = $token;
        $getuser->reset_expiry_datetime = $expirydate;
        $getuser->save();

        \Mail::to($getuser->email)->send(new \App\Mail\resetpass($getuser->username,$url));

        return redirect('/')->with('success', "Password reset link has been sent to $getuser->email!");
    }


    }

    public function resetpassword($token){

        $user = User::where('reset_password_token',$token)->first();

        if($user == ''){
            return redirect('/')->with('error', 'Invalid Password Reset Request!');
        }
        
        $nowDate = Carbon::now();
        $result = $nowDate->gt($user->reset_expiry_datetime);

        if($result == true){
            return redirect('/forgotpass')->with('error', 'Password reset link has been expired! Please request new Password reset!');
        }

       return view('Auth.resetpassword',compact('user'));


   
    }

    public function updatepassword(Request $request){

        $id = $request->input('id');
        $password = $request->input('password');
        $repassword = $request->input('repassword');

        if($password != $repassword){
        return redirect()->back()->with('error', 'The Password and Re Password does not match!');
        }

        $user = User::where('id',$id)->first();

        $user->reset_password_token = NULL;
        $user->reset_expiry_datetime = NULL;
        $user->password = Hash::make($password);
        $user->save();

        return redirect('/')->with('success', 'Password has been updated! Please login to your account!');
    }

    public function login(Request $request)
    {



        $user = User::where('username',$request->input('username'))->where('status','A')->where('role','Teacher')->first();

        if($user != ''){

            if(Hash::check($request->input('password'), $user->password)){
                auth()->login($user);

       
             
                    return redirect()->to('/teacherdashboard');
           
            }
            else{
                return redirect()->back()->with('error', 'The Username or Password is incorrect, Please try again');
            }

            

        }
        else{
            return redirect()->back()->with('error', 'The Username or Password is incorrect, Please try again');
        }
    }


    public function loginadmin(Request $request)
    {




        $user = User::where('username',$request->input('username'))->where('status','A')->where('role','Admin')->first();

        if($user != ''){

            if(Hash::check($request->input('password'), $user->password)){
                auth()->login($user);

       
             
                    return redirect()->to('/admindashboard');
           
            }
            else{
                return redirect()->back()->with('error', 'The Username or Password is incorrect, Please try again');
            }

            

        }
        else{
            return redirect()->back()->with('error', 'The Username or Password is incorrect, Please try again');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'mobile' => 'required|numeric',
            'department' => 'required|string|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                // At least one lowercase letter, one uppercase letter, and one digit
            ],
            'cpassword' => 'required|string|same:password', // Ensure confirmation matches password
        ]);
    
        $emailCheck = User::where('email', $request->input('email'))->count();
        $usernameCheck = User::where('username', $request->input('username'))->count();
    
        if ($emailCheck > 0) {
            return redirect()->back()->with('error', 'The Email already exists!');
        } elseif ($usernameCheck > 0) {
            return redirect()->back()->with('error', 'The Username already exists!');
        }
    
        // Create a new user
        $user = new User;
        $user->username = $request->input('username');
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->department = $request->input('department');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'Teacher';
        $user->status = 'A';
        $user->updated_at = Carbon::now();
        $user->save();
    
        return redirect('/')->with('success', 'Registration has been successfully saved! Please login to your Account.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuthenticationController  $authenticationController
     * @return \Illuminate\Http\Response
     */
    public function show(AuthenticationController $authenticationController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuthenticationController  $authenticationController
     * @return \Illuminate\Http\Response
     */
    public function edit(AuthenticationController $authenticationController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuthenticationController  $authenticationController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuthenticationController $authenticationController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuthenticationController  $authenticationController
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuthenticationController $authenticationController)
    {
        //
    }

    public function signout(Request $request)
    {
        auth()->logout();
        return redirect('/');
    }
}
