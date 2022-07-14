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
        try {

            $calculatingPeriodAccount = CalculatingPeriodAccount::query()->where([
                ['user_id', '=', $request->user()->user_id],
                ['status', '=', 'active']
            ])->firstOrFail();

            $billingCycleAccount = BillingCycleAccount::query()->where([
                ['user_id', '=', $request->user()->user_id],
                ['status', '=', 'active']
            ])->firstOrFail();

            return response()->json([
                "status"=>0,
                "sucess"=>true,
                "message"=>"Service accounts fetched sucessfully.",
                "data"=>[
                    "calculatingPeriodAccount"=> $calculatingPeriodAccount,
                    "billingCycleAccount"=> $billingCycleAccount,
                ],
            ],200);

        } catch (\Throwable $th) {
            return response()->json(["message"=>"User Has No any recurring balances"], 404);
        }
    }
}
