<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Requests\PurchasePolicyRequest;
use App\Models\Payment;
use App\Models\User;
use App\Services\AspinEngine;
use App\Services\BillingCycleAccountService;
use App\Services\BillingService;
use App\Services\MpesaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "status" => 0,
            "success" => true,
            "message" => "Payments fetched sucessfully",
            "data" => Payment::all()->where(["Status" => "paid"])
        ]);
    }

    public function callback(Request $request)
    {

        $response = json_decode($request->getContent());

        $resultCode = $response->Body->stkCallback->ResultCode;
        $checkoutRequestID = $response->Body->stkCallback->CheckoutRequestID;

        if ($resultCode == 0) {
            $metaData = $response->Body->stkCallback->CallbackMetadata;

            Payment::query()->where("CheckoutRequestID", $checkoutRequestID)->update([
                "MpesaReceiptNumber" => $metaData->Item[1]->Value,
                "TransactionDate" => $metaData->Item[2]->Value,
                "Status" => "paid"
            ]);

            $payment = Payment::where("CheckoutRequestID", $checkoutRequestID)->first();
            $user = User::where("user_id", $payment->UserId)->first()->get();

            // //Commiting to AspinEngine
            $engine = new AspinEngine();
            $engine->addPayments($payment);

            //Handling Billing Cycle Account
            $billing = new BillingCycleAccountService();
            $billing->create($payment);

            //Handling Premium Accounts
            $accounts = new BillingService();
            $accounts->create($payment);
        }
        Log::info("STK PUSH CALLBACK====" . json_encode($response));
    }

    public function userTransactions(Request $request)
    {
        return response()->json([
            "status" => 0,
            "success" => true,
            "message" => "Payments fetched sucessfully",
            "data" => Payment::all(),
        ]);
    }
}
