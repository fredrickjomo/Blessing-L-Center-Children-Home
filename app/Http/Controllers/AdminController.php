<?php

namespace App\Http\Controllers;

use App\Staff_members;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contacts;
use App\Children;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();

        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();

        $all_messages=Contacts::all();
        return view('Admin.home')->with(compact('users','children','messages',
            'activeSponsorship','all_messages','projects','events'));
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function viewChild(){
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
        $children_details=DB::table('childrens')->orderBy('full_name','asc')->paginate(10);


        return view('Admin/children.index')->with(compact('users','children',
            'messages','all_messages','projects','activeSponsorship','events','children_details','t_count'));


    }
    public function addChild(){

        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();

        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();

        $all_messages=Contacts::all();
        $children_details=Children::all();

        return view('Admin/children.add')->with(compact('users','children',
            'messages','all_messages','projects','activeSponsorship','events','children_details'));


    }
    public function editChild(){

        $t_count=1;
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();


        $all_messages=Contacts::all();
        $children_details=DB::table('childrens')->orderBy('full_name','asc')->paginate(10);

        return view('Admin/children.edit')->with(compact('users','children',
            'messages','all_messages','projects','events','children_details',
            'activeSponsorship','t_count'));
    }
    public function deleteChild(){
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
        $children_details=DB::table('childrens')->orderBy('full_name','asc')->paginate(10);

        return view('Admin/children.delete')->with(compact('users','children',
            'messages','all_messages','projects','events','activeSponsorship','children_details','t_count'));
    }
    //staff category

    public function viewStaff(){
        $t_count=1;
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();


        $all_messages=Contacts::all();
        $staff=Staff_members::orderBy('created_at','desc')->paginate(10);

        return view('Admin/staff.index')->with(compact('users','children',
            'messages','all_messages','projects','activeSponsorship','events','staff','t_count'));
    }
    public function addStaff(){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();

        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();

        $all_messages=Contacts::all();
        $staff=Staff_members::all();
        return view('Admin/staff.add')->with(compact('users','children',
            'messages','activeSponsorship','all_messages','projects','events','staff'));



    }

}
