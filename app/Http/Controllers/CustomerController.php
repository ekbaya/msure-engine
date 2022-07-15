<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\BillingCycleAccount;
use App\Models\CalculatingPeriodAccount;
use App\Models\Customer;
use App\Models\MedicalInsurance;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function serviceAccounts(Request $request)
    {
        $calculatingPeriodAccount = null;
        $billingCycleAccount = null;
        $daysCovered = [];
        $totalInsuranceAmount = 0;

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

        try {
            $daysCovered = MedicalInsurance::query()->where([
                ['user_id', '=', $request->user()->user_id]
            ])->get();
        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            $count = BillingCycleAccount::query()->where([
                ['user_id', '=', $request->user()->user_id],
                ['status', '=', 'closed']
            ])->count();
            $totalInsuranceAmount = 326 * $count;
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json([
            "status" => 0,
            "sucess" => true,
            "message" => "Service accounts fetched sucessfully.",
            "data" => [
                "insurance_amount" => $totalInsuranceAmount,
                "daily_contribution" => Customer::query()->where("user_id", $request->user()->user_id)->firstOrFail()->stage->daily_contribution,
                "calculatingPeriodAccount" => $calculatingPeriodAccount,
                "billingCycleAccount" => $billingCycleAccount,
                "settledDays" => $daysCovered,
            ],
        ], 200); 
    }
}
