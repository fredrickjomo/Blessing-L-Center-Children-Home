<?php

namespace App\Http\Controllers;

use App\Contacts;
use App\Staff_members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $staff=Staff_members::orderBy('year_of_birth','asc')->paginate(5);
        $number=1;
        return view('staff.index',compact('staff','number'));
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
        $validatedData = $request->validate([
            'first_name'=>'required|string|min:4|max:15',
            'middle_name'=>'max:15',
            'last_name'=>'required|string|min:4|max:15',
            'year_of_birth'=>'required|integer|min:1960',
            'gender'=>'required',
            'photo'=>'file|mimes:jpeg,jpg,bmp,png,svg|max:5000',
            'position'=>'required'
        ]);
        if($validatedData){
            $fileName='default.jpg';
            if($request->hasFile('photo')){
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('photo')->move(storage_path() . '/app/public/staff/', $fileName);
            }
            $staff=Staff_members::create([
                'first_name'=>$request->input('first_name'),
                'middle_name'=>$request->input('middle_name'),
                'last_name'=>$request->input('last_name'),
                'year_of_birth'=>$request->input('year_of_birth'),
                'gender'=>$request->input('gender'),
                'position'=>$request->input('position'),
                'photo'=>$fileName,

            ]);
            if($staff){
                flash('Staff information added successfully!')->success()->important();
                return back();
            }
            flash('Error occurred while adding staff information!.Please try again')->error()->important();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff_members  $staff_members
     * @return \Illuminate\Http\Response
     */
    public function show(Staff_members $staff_members)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff_members  $staff_members
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();

        $t_count=1;
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();

        $all_messages=Contacts::all();
      $staff=Staff_members::where('id',$id)->first();
      return view('Admin/staff.edit',compact('staff','activeSponsorship','users','children','messages','projects',
          'events','all_messages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff_members  $staff_members
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'first_name'=>'required|string|min:4|max:15',
            'middle_name'=>'max:15',
            'last_name'=>'required|string|min:4|max:15',
            'year_of_birth'=>'required|integer|min:1960',
            'gender'=>'required',
            'photo'=>'file|mimes:jpeg,jpg,bmp,png,svg|max:5000',
            'position'=>'required'
        ]);
        if ($validatedData){
            $staff=Staff_members::where('id',$id)->first();
            $fileName=$staff->photo;
            if($request->hasFile('photo') && $fileName!='default.jpg'){
                Storage::disk('local')->delete('public/staff/'.$staff->photo);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('photo')->move(storage_path() . '/app/public/staff/', $fileName);
            }else{
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('photo')->move(storage_path() . '/app/public/staff/', $fileName);
            }
            $staff_update=Staff_members::where('id',$id)
                ->update([
                    'first_name'=>$request->input('first_name'),
                    'middle_name'=>$request->input('middle_name'),
                    'last_name'=>$request->input('last_name'),
                    'year_of_birth'=>$request->input('year_of_birth'),
                    'gender'=>$request->input('gender'),
                    'position'=>$request->input('position'),
                    'photo'=>$fileName,
                ]);
            if($staff_update){
                flash('Staff information successfully updated')->success()->important();
                return back();
            }
            flash('An error occurred while trying to update the staff information!.Please try again')->error()->important();
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff_members  $staff_members
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       $staff_delete=Staff_members::where('id',$id)->first();
       if($staff_delete && $staff_delete->photo!='default.jpg'){
           Storage::disk('local')->delete('public/staff/'.$staff_delete->photo);
           $staff_delete->delete();
           flash('Staff member succeessfully deleted!')->success();
           return back();
       }
       else if ($staff_delete && $staff_delete->photo=='default.jpg'){
           $staff_delete->delete();
           flash('Staff member succeessfully deleted!')->success();
           return back();
       }else{
           flash('An error occurred while trying to delete a staff member!.Please try again')->error()->important();
           return back();
       }

    }
}
