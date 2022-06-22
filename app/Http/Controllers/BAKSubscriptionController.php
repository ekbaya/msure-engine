<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBAKSubscriptionRequest;
use App\Http\Requests\UpdateBAKSubscriptionRequest;
use App\Models\BAKSubscription;

class BAKSubscriptionController extends Controller
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
     * @param  \App\Http\Requests\StoreBAKSubscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBAKSubscriptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BAKSubscription  $bAKSubscription
     * @return \Illuminate\Http\Response
     */
    public function show(BAKSubscription $bAKSubscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BAKSubscription  $bAKSubscription
     * @return \Illuminate\Http\Response
     */
    public function edit(BAKSubscription $bAKSubscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBAKSubscriptionRequest  $request
     * @param  \App\Models\BAKSubscription  $bAKSubscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBAKSubscriptionRequest $request, BAKSubscription $bAKSubscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BAKSubscription  $bAKSubscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(BAKSubscription $bAKSubscription)
    {
        //
    }
}
