<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::where('id',Auth::id())->first();
        return view('home',compact('user'));
    }
    public function about_us(){
        return view('about_us');
    }
    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }
    public function changePassword(Request $request){
        if(!(Hash::check($request->get('current-password'),Auth::user()->password))){

            return redirect()->back()->with('error','Your current password does not match with the password you provided.
            Please try again!');
        }
        if (strcmp($request->get('current-password'),$request->get('new-password'))==0){
            return redirect()->back()->with('error','New Password cannot be same as your current password. Please choose a different password. ');

        }
        $validatedData = $request->validate([
            'current-password'=>'required',
            'new-password' => 'required|string|min:6|confirmed',

        ]);
        //change user password
        $user=Auth::user();
        $user->password=bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with('success','Password changed successfully!');
    }
    public function pageNotFound(){
        return view('error pages.404_error_page');
    }
}
