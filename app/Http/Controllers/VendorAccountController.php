<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorAccountRequest;
use App\Http\Requests\UpdateVendorAccountRequest;
use App\Models\VendorAccount;

class VendorAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreVendorAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorAccount  $vendorAccount
     * @return \Illuminate\Http\Response
     */
    public function show(VendorAccount $vendorAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorAccount  $vendorAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorAccount $vendorAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorAccountRequest  $request
     * @param  \App\Models\VendorAccount  $vendorAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorAccountRequest $request, VendorAccount $vendorAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorAccount  $vendorAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorAccount $vendorAccount)
    {
        //
    }
}
