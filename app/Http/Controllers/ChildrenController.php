<?php

namespace App\Http\Controllers;

use App\Children;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Contacts;
use Image;
use File;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    //protected $table=('childrens');
    public function index()
    {
        //
       // $users=DB::table('childrens')->count(); //-getting total row count
        $users=1;


       // dd($users);

       // $children=Children::all();
        $children=DB::table('childrens')
            ->select('childrens.id','childrens.full_name','childrens.photo','childrens.age',
                'childrens.gender','childrens.education_level','childrens.vulnerability')
            ->whereNotIn('childrens.id',DB::table('sponsorships')->pluck('child_id'))
            ->get();
        return view('children.index')->with(compact('users','children'));

        //return view('Children.index',['children'=>$children]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('Children.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Children $children)
    {
        $validatedData = $request->validate([
            'full_name'=>'required|min:10',
            'gender' => 'required',
            'year_of_birth'=>'required|integer|min:1998|max:2018',
            'vulnerability'=>'required',
            'education_level'=>'required',
            'photo'=>'file|mimes:jpeg,jpg,bmp,png,svg|max:5000',
        ]);


        $fileName='default.jpg';
        if($request->hasFile('photo')){
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = rand(00000001, 99999999) . '.' . $extension;
            Input::file('photo')->move(storage_path() . '/app/public/children/', $fileName);
        }
        //

        if (Auth::check()){
            $children=Children::create([
                'full_name'=>$request->input('full_name'),
                'gender'=>$request->input('gender'),
                'year_of_birth'=>$request->input('year_of_birth'),
                'vulnerability'=>$request->input('vulnerability'),
                'education_level'=>$request->input('education_level'),
                'photo'=>$fileName,
            ]);
            if ($children){
                flash('Child Information Added Successfully')->success()->important();
                return redirect()->route('Admin.addChild');
                   // ->with('success','Child Information Added Successfully');

            }
            return back()->withInput()->with('errors','Error in adding child information...try again!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function show(Children $children)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function edit(Children $child)
    {
        //
        $t_count=1;
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

        $child=Children::where('id',$child->id)->first();
       // dd($children);


        return view('Admin/children.editFile')->with(compact('child','t_count','users','children','messages','projects','events'
        ,'all_messages','activeSponsorship','children_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Children $child)
    {
        //
        $validatedData = $request->validate([
            'full_name' => 'required|min:10',
            'gender' => 'required',
            'year_of_birth' => 'required|integer|min:1998|max:2018',
            'vulnerability' => 'required',
            'education_level' => 'required',
            'photo' => 'file|mimes:jpeg,jpg,bmp,png,svg|max:5000',
        ]);
        if ($validatedData) {
            $child = Children::where('id', $child->id)->first();
            $fileName = $child->photo;
            if ($request->hasFile('photo') && $fileName != 'default.jpg') {
                Storage::disk('local')->delete('public/children/' . $child->photo);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('photo')->move(storage_path() . '/app/public/children/', $fileName);

            } else if ($request->hasFile('photo')){
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('photo')->move(storage_path() . '/app/public/children/', $fileName);
            }
            $childUpdate = Children::where('id', $child->id)
                ->update([
                    'full_name' => $request->input('full_name'),
                    'gender' => $request->input('gender'),
                    'year_of_birth' => $request->input('year_of_birth'),
                    'vulnerability' => $request->input('vulnerability'),
                    'education_level' => $request->input('education_level'),
                    'photo' => $fileName,

                ]);
            if ($childUpdate) {
                flash('Child Information updated successfully')->success()->important();
                return redirect()->route('Admin.viewChild');
            }
            flash('An error occurred while trying to update child information! Please try again')->error()->important();
            return back();

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Children  $children
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $child = Children::where('id', $id)->first();
        if($child && $child->photo!='default.jpg'){
            Storage::disk('local')->delete('public/children/'.$child->photo);
            $child->delete();
            flash('Child successfully deleted!')->success()->important();
            return back();
        } else if ($child && $child->photo=='default.jpg'){
            $child->delete();
            flash('Child successfully deleted!')->success();
            return back();
        }else{
            flash('An error occurred while trying to delete this child!.Please try again')->error()->important();
            return back();
        }

    }
    public function search_child(Request $request){

        $count=1;
        $keyword=Input::get('keyword','');
        $child=Children::SearchByKeyword($keyword)->paginate(5);
        if($child->isEmpty()){
            flash('No details found for "'.$keyword.'" .Try searching again!');
            return back();
        }
        return view('searches.index',compact('child','count','keyword'));

//dd($child);

    }
    public function adminSearch(Request $request, Children $child){
        $count=1;
        $t_count=1;
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

        $child=Children::where('id',$child->id)->first();
        $keyword=Input::get('keyword','');
        $child=Children::SearchByKeyword($keyword)->paginate(5);
        if($child->isEmpty()){
            flash('No details found for "'.$keyword.'" .Try searching again!');
            return back();
        }
        return view('Admin/children.searchChild',compact('child','count','keyword',
            'users','children','projects','events','activeSponsorship'));

    }
    public function our_children(){
        $number=1;
        $children=Children::orderBy('created_at','desc')->paginate(5);
        return view('children.show',compact('children','number'));
    }

}
