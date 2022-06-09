<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AspinEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $data = $request->all();
        foreach ($data as $key => $value) {
            Log::info("Updating " . $key . "With  " . $value);
            if (!($key && $value)) {
                return response()->json([
                    "success" => true,
                    "status" => 0,
                    "message" => "Failed to update " . $key,
                    "error" => $key . " is required"
                ]);
            }
            $request->user()->update(
                [
                    $key => $value //"beneficiary_name"=>"Alice Kadzo"
                ]
            );
        }

        $u = $request->user()->fresh();
        //Update User user to ASPIN ENGINE
        $engine = new AspinEngine();
        $engine->updateCustomer($u);

        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "success",
            "data" => $request->user()
        ]);
    }
}
