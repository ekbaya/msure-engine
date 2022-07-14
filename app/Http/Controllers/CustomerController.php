<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\BillingCycleAccount;
use App\Models\CalculatingPeriodAccount;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function serviceAccounts(Request $request)
    {
        $calculatingPeriodAccount = null;
        $billingCycleAccount = null;
        try {
            $calculatingPeriodAccount = CalculatingPeriodAccount::query()->where([
                ['user_id', '=', $request->user()->user_id],
                ['status', '=', 'active']
            ])->firstOrFail();
        } catch (\Throwable $th) {
            //throw $th;
        }
        try {

            $billingCycleAccount = BillingCycleAccount::query()->where([
                ['user_id', '=', $request->user()->user_id],
                ['status', '=', 'active']
            ])->firstOrFail();

        } catch (\Throwable $th) {
         
        }

        return response()->json([
            "status" => 0,
            "sucess" => true,
            "message" => "Service accounts fetched sucessfully.",
            "data" => [
                "calculatingPeriodAccount" => $calculatingPeriodAccount,
                "billingCycleAccount" => $billingCycleAccount,
            ],
        ], 200);
    } 
}
