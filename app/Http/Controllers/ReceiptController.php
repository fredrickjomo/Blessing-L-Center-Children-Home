<?php

namespace App\Http\Controllers;

use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

class ReceiptController extends Controller
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
            'receipt'=>'required|file|mimes:jpeg,jpg,bmp,png,svg,pdf|max:5000',
        ]);
        if(Auth::check()){
            $extension=$request->file('receipt')->getClientOriginalExtension();
            $fileName=rand(00000001,99999999).'.'.$extension;
            if($request->hasFile('receipt')){

                $receipt=Receipt::create([
                    'user_id'=>$request->user()->id,
                    'receipt'=>$fileName,
                    Input::file('receipt')->move(storage_path().'/app/public/receipts/',$fileName),
                ]);
                if($receipt){
                    flash('Upload Successfull!, Your sponsorship will be marked active after counter-checking your receipt.')
                        ->success();
                    return redirect()->back();
                }

                dd($fileName);
            }

        }


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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
