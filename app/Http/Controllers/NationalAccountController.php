<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNationalAccountRequest;
use App\Http\Requests\UpdateNationalAccountRequest;
use App\Models\NationalAccount;

class NationalAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreNationalAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNationalAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NationalAccount  $nationalAccount
     * @return \Illuminate\Http\Response
     */
    public function show(NationalAccount $nationalAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NationalAccount  $nationalAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(NationalAccount $nationalAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNationalAccountRequest  $request
     * @param  \App\Models\NationalAccount  $nationalAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNationalAccountRequest $request, NationalAccount $nationalAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NationalAccount  $nationalAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(NationalAccount $nationalAccount)
    {
        //
    }
}
