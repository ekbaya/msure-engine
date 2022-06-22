<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionAccountRequest;
use App\Http\Requests\UpdateRegionAccountRequest;
use App\Models\RegionAccount;

class RegionAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreRegionAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegionAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegionAccount  $regionAccount
     * @return \Illuminate\Http\Response
     */
    public function show(RegionAccount $regionAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegionAccount  $regionAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(RegionAccount $regionAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegionAccountRequest  $request
     * @param  \App\Models\RegionAccount  $regionAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegionAccountRequest $request, RegionAccount $regionAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegionAccount  $regionAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegionAccount $regionAccount)
    {
        //
    }
}
