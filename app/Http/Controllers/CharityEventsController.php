<?php

namespace App\Http\Controllers;

use App\Charity_Events;
use App\Contacts;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class CharityEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $t_count=1;
        $event=Charity_Events::orderBy('created_at','desc')->paginate(5);
        return view('charity_events.index',compact('event','t_count'));
    }
    public function display_event($id){
        $event=Charity_Events::where('id',$id)
            ->first();
        return view('charity_events.display_event',compact('event'));
    }
    public function add_event(){
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

        return view('Admin/charity_events.add',compact('activeSponsorship','users','children','messages','projects',
            'events','all_messages'));
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
            'name'=>'required|min:10',
            'purpose' => 'string|required|min:10',
            'date'=>'required|string|max:20',
            'venue'=>'required',
            'photo'=>'file|mimes:jpeg,jpg,bmp,png,svg|max:5000',
        ]);
        if($validatedData){
            $check_date=DB::table('charity_events')->where('date_of_event',$request->input('date'))
                ->exists();
            if($check_date==true){
                flash('Another Event Scheduled For The Same Day exists! Please Choose a Different Date')->error()->important();
                return back();
            }

            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = rand(00000001, 99999999) . '.' . $extension;
            $event=Charity_Events::create([
                'name'=>$request->input('name'),
                'purpose'=>$request->input('purpose'),
                'date_of_event'=>$request->input('date'),
                'venue'=>$request->input('venue'),
                'photo'=>$fileName,
                Input::file('photo')->move(storage_path() . '/app/public/charity_events/', $fileName),
            ]);
            if($event){
                flash('Event successfully added')->success();
                return back();
                //return 'Success';

            }
             flash('Failed!, Please try again')->error();
                return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Charity_Events  $charity_Events
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        $events_list=Charity_Events::orderBy('created_at','desc')->paginate(5);
        return view('Admin/charity_events.show',compact('events_list','activeSponsorship','users','children','messages',
            'projects','events','all_messages','t_count'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Charity_Events  $charity_Events
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
        $event=Charity_Events::where('id',$id)->first();
        return view('Admin/charity_events.edit',compact('event','activeSponsorship','users','children',
            'messages','projects','events','messages','all_messages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Charity_Events  $charity_Events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $event=Charity_Events::where('id',$id)->first();
        $fileName=$event->photo;
        if($request->hasFile('photo')){

            Storage::disk('local')->delete('public/charity_events/'.$event->photo);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = rand(00000001, 99999999) . '.' . $extension;
            Input::file('photo')->move(storage_path() . '/app/public/charity_events/', $fileName);
        }

       $event_update=Charity_Events::where('id',$id)
           ->update([
               'name'=>$request->input('name'),
               'purpose'=>$request->input('purpose'),
               'date_of_event'=>$request->input('date'),
               'venue'=>$request->input('venue'),
               'photo'=>$fileName,
           ]);
        if($event_update){
            flash('Event information was updated successfully!')->success()->important();
            return back();
        }
        flash('An error occurred whilr trying to update event information! Please try again')->error()->important();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Charity_Events  $charity_Events
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $event=Charity_Events::where('id',$id)->first();
       if ($event){
           Storage::disk('local')->delete('public/charity_events/'.$event->photo);
           $event->delete();
           flash('Event deletion successful')->success();
           return back();
       }
       flash('Error occurred while deleting event! Please try again')->error();
    }
}
