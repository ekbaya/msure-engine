<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWardAccountRequest;
use App\Http\Requests\UpdateWardAccountRequest;
use App\Models\WardAccount;

class WardAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreWardAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWardAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WardAccount  $wardAccount
     * @return \Illuminate\Http\Response
     */
    public function show(WardAccount $wardAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WardAccount  $wardAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(WardAccount $wardAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWardAccountRequest  $request
     * @param  \App\Models\WardAccount  $wardAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWardAccountRequest $request, WardAccount $wardAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WardAccount  $wardAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(WardAccount $wardAccount)
    {
        //
    }
}
