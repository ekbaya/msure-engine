<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AspinEngine;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 0,
            'success' => true,
            'message' => 'Users fetched successfully',
            'users' => User::all(),
        ]);
    }

    /**
     * Get the user status
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $engine = new AspinEngine();
        return $engine->getCustomerStatus($request->user());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->user()->update(
            [
                'beneficiary_phone' => $request->input('beneficiary_phone'),
                'beneficiary_name' => $request->input('beneficiary_name'),
            ]
        );

        return response()->json([
            'status' => 0,
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $request->user(),
        ]);
    }
}
