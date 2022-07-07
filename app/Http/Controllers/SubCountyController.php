<?php

namespace App\Http\Controllers;

use App\Models\SubCounty;
use App\Http\Requests\StoreSubCountyRequest;
use App\Http\Requests\UpdateSubCountyRequest;

class SubCountyController extends Controller
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
     * @param  \App\Http\Requests\StoreSubCountyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubCountyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCounty  $subCounty
     * @return \Illuminate\Http\Response
     */
    public function show(SubCounty $subCounty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCounty  $subCounty
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCounty $subCounty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubCountyRequest  $request
     * @param  \App\Models\SubCounty  $subCounty
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCountyRequest $request, SubCounty $subCounty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCounty  $subCounty
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCounty $subCounty)
    {
        //
    }
}
