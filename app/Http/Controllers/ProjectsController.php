<?php

namespace App\Http\Controllers;

use App\Contacts;
use App\Projects;
use Carbon\Carbon;
use Faker\Provider\ka_GE\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
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

        $t_count=1;
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();

        $all_messages=Contacts::all();
        return view('Admin/projects.add',compact('activeSponsorship','users','children','messages','projects',
            'events','messages','all_messages'));
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
            'name'=>'required|min:5',
            'purpose' => 'string|required|min:10',
            'start_date'=>'required|',
            'duration'=>'string',
            'end_date'=>'required',
            'photo'=>'required|file|mimes:jpeg,jpg,bmp,png,svg|max:5000',
        ]);
        if ($validatedData){
            $s_date=new Carbon($request->input('start_date'));
            $e_date=new Carbon($request->input('end_date'));
            $duration=($e_date->diff($s_date)->days<1)? 'today':$e_date->diffForHumans($s_date);

            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = rand(00000001, 99999999) . '.' . $extension;
            $project=Projects::create([
               'name'=>$request->input('name'),
               'purpose'=>$request->input('purpose'),
                'duration'=>$duration,
                'start_date'=>$request->input('start_date'),
                'end_date'=>$request->input('end_date'),
                'photo'=>$fileName,
                Input::file('photo')->move(storage_path() . '/app/public/projects/', $fileName),
            ]);
            if ($project){
                flash('Project successfully added!')->success()->important();
                return back();
            }
            flash('Error occurred while adding a project! Try again')->error();
            return back();

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projects  $projects
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
        $project=Projects::orderBy('created_at','desc')->paginate(5);
        return view('Admin/projects.show',compact('project','activeSponsorship','t_count','users','children','messages',
            'projects','events','all_messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projects  $projects
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
        $project=Projects::where('id',$id)->first();
        return view('Admin/projects.edit',compact('project','activeSponsorship','users','children','messages',
            'projects','events','all_messages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $validatedData = $request->validate([
            'name'=>'required|min:5',
            'purpose' => 'string|required|min:10',
            'start_date'=>'required|',
            'duration'=>'string',
            'end_date'=>'required',
            'photo'=>'file|mimes:jpeg,jpg,bmp,png,svg|max:5000',
        ]);
        if($validatedData){
            $project=Projects::where('id',$id)->first();
            $fileName=$project->photo;

            $s_date=new Carbon($request->input('start_date'));
            $e_date=new Carbon($request->input('end_date'));
            $duration=($e_date->diff($s_date)->days<1)? 'today':$e_date->diffForHumans($s_date);
            if($request->hasFile('photo')){

                Storage::disk('local')->delete('public/projects/'.$project->photo);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('photo')->move(storage_path() . '/app/public/projects/', $fileName);
            }
            $project_update=Projects::where('id',$id)
                ->update([
                    'name'=>$request->input('name'),
                    'purpose'=>$request->input('purpose'),
                    'duration'=>$duration,
                    'start_date'=>$request->input('start_date'),
                    'end_date'=>$request->input('end_date'),
                    'photo'=>$fileName,
                ]);
            if($project_update){
                flash('Project information successfully updated!')->success()->important();
                return back();
            }
            flash('Error occurred while updating the project information')->important()->error();
            return back();

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $project_delete=Projects::where('id',$id)->first();
        if($project_delete){
            Storage::disk('local')->delete('public/projects/'.$project_delete->photo);
            $project_delete->delete();
            flash('Project succeessfully deleted!')->success();
            return back();
        }
        flash('Error occurred while trying to delete this project!. Please try again')->error()->important();
        return back();
    }
    public function display_projects(){
        $projects=Projects::orderBy('created_at','desc')->paginate(10);
        return view('projects.index',compact('projects'));
    }
    public function support_project($id){
    $project=Projects::where('id',$id)->first();
    return view('projects.support',compact('project'));
    }
    public function bank_support($id){
        $project=Projects::where('id',$id)->first();
        return view('projects.bank_support',compact('project'));
    }
}
