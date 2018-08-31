<?php

namespace App\Http\Controllers;

use App\Countries;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=User::where('id',Auth::user()->id)->first();
        return view('user.index',compact('user'));

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
      $user=User::select('users.first_name','users.last_name','users.gender','users.nationality',
          'users.email','users.photo')->where('id',$id)->first();
      $nationality=Countries::orderBy('name','asc')->get();
      return view('user.edit',compact('user','nationality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        //
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'nationality'=>'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'photo'=>'file|mimes:jpeg,jpg,bmp,png,svg|max:5000'
        ]);
        if ($validatedData){
            $user=User::where('email',$email)->first();
            $fileName=$user->photo;
            if($request->hasFile('photo') && $fileName!='default.jpg'){
                Storage::disk('local')->delete('public/profile/'.$user->photo);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('photo')->move(storage_path() . '/app/public/profile/', $fileName);
            }
            elseif ($request->hasFile('photo') && $fileName=='default.jpg'){
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('photo')->move(storage_path() . '/app/public/profile/', $fileName);
            }
//            else{
//                $extension = $request->file('photo')->getClientOriginalExtension();
//                $fileName = rand(00000001, 99999999) . '.' . $extension;
//                Input::file('photo')->move(storage_path() . '/app/public/profile/', $fileName);
//            }

            $user_update=User::where('email',$email)
                ->update([
                    'first_name'=>$request->input('first_name'),
                    'last_name'=>$request->input('last_name'),
                    'gender'=>$request->input('gender'),
                    'nationality'=>$request->input('nationality'),
                    'photo'=>$fileName,

                ]);
            if ($user_update){
                flash('Your profile was successfully updated')->success()->important();
                return redirect('/check-my-profile');
            }
            flash('An error occurred while trying to update your profile! Please try again')->error()->important();
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
