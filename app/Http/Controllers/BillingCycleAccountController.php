<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillingCycleAccountRequest;
use App\Http\Requests\UpdateBillingCycleAccountRequest;
use App\Models\BillingCycleAccount;

class BillingCycleAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreBillingCycleAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillingCycleAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillingCycleAccount  $billingCycleAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BillingCycleAccount $billingCycleAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillingCycleAccount  $billingCycleAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BillingCycleAccount $billingCycleAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBillingCycleAccountRequest  $request
     * @param  \App\Models\BillingCycleAccount  $billingCycleAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillingCycleAccountRequest $request, BillingCycleAccount $billingCycleAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillingCycleAccount  $billingCycleAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillingCycleAccount $billingCycleAccount)
    {
        //
    }
}
