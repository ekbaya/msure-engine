<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\BillingCycleAccount;
use App\Models\CalculatingPeriodAccount;
use App\Models\Customer;
use App\Models\MedicalCardAndDelivery;
use App\Models\MedicalInsurance;
use App\Models\Cover;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function serviceAccounts(Request $request)
    {
        $calculatingPeriodAccount = null;
        $billingCycleAccount = null;
        $medicalCardAndDeliveryCost = null;
        $daysCovered = [];
        $totalInsuranceAmount = 0;
        $billingCycleAccountAmount = 0;
        $medicalCardAndDeliveryCostBalance = 461;

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
            $billingCycleAccountAmount = $billingCycleAccount->amount;
        } catch (\Throwable $th) {
        }

        try {
            $medicalCardAndDeliveryCost = MedicalCardAndDelivery::query()->where([
                ['user_id', '=', $request->user()->user_id]
            ])->firstOrFail();

            if ($medicalCardAndDeliveryCost->status === "settled") {
                $medicalCardAndDeliveryCostBalance = 0;
            } else {
                $medicalCardAndDeliveryCostBalance = (461 - ($medicalCardAndDeliveryCost->amount + $billingCycleAccountAmount));
            }
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
            $covers = Cover::query()->where([
                ['user_id', '=', $request->user()->user_id]
            ])->get();

            foreach ($covers as $cover) {
                $totalInsuranceAmount += $cover->amount;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json([
            "status" => 0,
            "sucess" => true,
            "message" => "Service accounts fetched sucessfully.",
            "data" => [
                "insurance_amount" => (string)$totalInsuranceAmount,
                "daily_contribution" => Customer::query()->where("user_id", $request->user()->user_id)->firstOrFail()->stage->daily_contribution,
                "calculatingPeriodAccount" => $calculatingPeriodAccount,
                "billingCycleAccount" => $billingCycleAccount,
                "medicalCardAndDeliveyCost" => $medicalCardAndDeliveryCost,
                "settledDays" => $daysCovered,
                "inceptionPayment" => [
                    "inception_date" => $request->user()->created_at,
                    "amount" => 461,
                    "balance" => $medicalCardAndDeliveryCostBalance,
                    "cover_amount" => 326,
                    "medical_card" => 135,
                ]
            ],
        ], 200);
    }

    public function updateOrganization(UpdateOrganizationRequest $request)
    {
        Customer::query()->where("user_id", $request->user()->user_id)->update([
            "organization_id" => $request->organization_id,
        ]);

        return response()->json([
            "sucess"=>true,
            "status" => 0,
            "message" => "Account updated successfully",
            "data" => Customer::query()->where("user_id", $request->organization_id)
        ]);
    }
}
