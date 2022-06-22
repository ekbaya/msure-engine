<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountyAccountRequest;
use App\Http\Requests\UpdateCountyAccountRequest;
use App\Models\CountyAccount;

class CountyAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreCountyAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountyAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountyAccount  $countyAccount
     * @return \Illuminate\Http\Response
     */
    public function show(CountyAccount $countyAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountyAccount  $countyAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(CountyAccount $countyAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountyAccountRequest  $request
     * @param  \App\Models\CountyAccount  $countyAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountyAccountRequest $request, CountyAccount $countyAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountyAccount  $countyAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountyAccount $countyAccount)
    {
        //
    }
}
