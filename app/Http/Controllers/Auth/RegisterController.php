<?php

namespace App\Http\Controllers\Auth;

use App\Countries;
use App\Mail\VerifyMail;
use App\Mail\WelcomeMail;
use App\User;
use App\Http\Controllers\Controller;
use App\Verifyuser;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image;
use File;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'nationality'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:6|confirmed',
            'photo'=>'file|mimes:jpeg,jpg,bmp,png,svg|max:5000'
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request=request();
        $photo='default.jpg';
        if($request->hasFile('photo')) {
            $destinationPath = '/children_photo/';
            $file = $request->photo;
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(0101, 9999) . Auth::id() . '-profile_photo' . $extension;
            Image::make($file)->resize(400, 300)->save(public_path('/profile_pictures/' . $fileName));
            $file->move($destinationPath, $fileName);

            $photo = $fileName;
        }
        $user=User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'nationality' => $data['nationality'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'photo'=>$photo,
        ]);
        if ($user){
            $verifyUser=Verifyuser::create([
                'user_id'=>$user->id,
                'token'=>str_random(40),
            ]);
            Mail::to($user->email)->send(new VerifyMail($user));
            return $user;

//            Mail::to($data['email'])->send(new WelcomeMail($user));
//            return $user;
        }

    }
    public function showRegistrationForm()
    {
        $countries=Countries::all();
        return view("auth.register",compact("countries"));
    }
    public function verifyUser($token){
        $verifyUser=Verifyuser::where('token',$token)->first();
        if(isset($verifyUser)){
            $user=$verifyUser->user;
            if (!$user->verified){
                $verifyUser->user->verified=1;
                $verifyUser->user->save();
                Mail::to($user['email'])->send(new WelcomeMail($user));
                $status="Email Successfully verified. You can now login in with your credentials";
            }else{
                $status="Email Already verified. Login in with your credentials.";
            }
        }else{
            flash('Email cannot be verified. Please try again with a valid email address');
            return redirect('/login');
        }
        flash($status);
        return redirect('/login');
    }
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        flash('We sent an activation code. Check your email and click on the link to verify.')->success();
        return redirect('/login');
    }

}
