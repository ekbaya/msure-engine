<?php

namespace App\Http\Controllers;

use App\Models\InsuranceProvider;
use App\Http\Requests\StoreInsuranceProviderRequest;
use App\Http\Requests\UpdateInsuranceProviderRequest;

class InsuranceProviderController extends Controller
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
     * @param  \App\Http\Requests\StoreInsuranceProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInsuranceProviderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InsuranceProvider  $insuranceProvider
     * @return \Illuminate\Http\Response
     */
    public function show(InsuranceProvider $insuranceProvider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InsuranceProvider  $insuranceProvider
     * @return \Illuminate\Http\Response
     */
    public function edit(InsuranceProvider $insuranceProvider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInsuranceProviderRequest  $request
     * @param  \App\Models\InsuranceProvider  $insuranceProvider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInsuranceProviderRequest $request, InsuranceProvider $insuranceProvider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InsuranceProvider  $insuranceProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy(InsuranceProvider $insuranceProvider)
    {
        //
    }
}
