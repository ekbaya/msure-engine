<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Customer;
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
            'customers' => Customer::all(),
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
        $customer = Customer::where('user_id', $request->user()->user_id)->first();
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

            $customer->update(
                [
                    $key => $value //"beneficiary_name"=>"Alice Kadzo"
                ]
            );
        }

        $c = $customer->fresh();
        //Update Customer to ASPIN ENGINE
        $engine = new AspinEngine();
        $engine->updateCustomer($c);

        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "success",
            "data" => $c
        ]);
    }

    public function store(UpdateProfileRequest $request, User $user)
    {
        $user->storeUser($request)->storeMedia($request);

        return 'Image uploaded successfully';
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $path = $request->file('image')->store('public/images');
        $request->user()->update([
            "image" => $path,
        ]);
        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "User updated successfully",
            "data" => $request->user()
        ]);
    }
}
