<?php

namespace App\Http\Controllers;

use App\About_Us;
use Illuminate\Http\Request;

class About_UsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('AboutUs.about_us');
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
     * @param  \App\About_Us  $about_Us
     * @return \Illuminate\Http\Response
     */
    public function show(About_Us $about_Us)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About_Us  $about_Us
     * @return \Illuminate\Http\Response
     */
    public function edit(About_Us $about_Us)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About_Us  $about_Us
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About_Us $about_Us)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About_Us  $about_Us
     * @return \Illuminate\Http\Response
     */
    public function destroy(About_Us $about_Us)
    {
        //
    }
}
