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
        Mail::to($data['email'])->send(new WelcomeMail($user));
        return $user;
    }
    public function showRegistrationForm()
    {
        $countries=Countries::all();
        return view("auth.register",compact("countries"));
    }

}
