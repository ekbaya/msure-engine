<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitiatePaymentRequest;
use App\Models\Payment;
use App\Models\User;
use App\Services\AspinEngine;
use App\Services\BillingCycleAccountService;
use App\Services\BillingService;
use App\Services\EquityService;
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
            "data" => Payment::all()->where("Status", "paid")
        ]);
    }

    public function callback(Request $request)
    {

        $response = json_decode($request->getContent());

        $resultCode = $response->Body->stkCallback->ResultCode;
        $checkoutRequestID = $response->Body->stkCallback->CheckoutRequestID;

        if ($resultCode == 0) {
            $metaData = $response->Body->stkCallback->CallbackMetadata;

            Payment::query()->where("reference", $checkoutRequestID)->update([
                "transaction_id" => $metaData->Item[1]->Value,
                "transaction_date" => $metaData->Item[3]->Value,
                "status" => "paid"
            ]);

            $payment = Payment::where("reference", $checkoutRequestID)->first();

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
        $payments = [];
        if ($request->filter) {
            if ($request->filter == 'month') {
                $payments = $this->transactionsByMonth($request);
            } else if ($request->filter == 'year') {
                $payments = $this->transactionsByYear($request);
            } else if ($request->filter == 'day') {
                $payments = $this->transactionsByDay($request);
            } else {
                $payments = $this->allTransactions($request);
            }
        } else {
            $payments = $this->allTransactions($request);
        }

        return response()->json([
            "status" => 0,
            "success" => true,
            "message" => "Payments fetched sucessfully",
            "data" => $payments,
        ]);
    }

    static function transactionsByMonth(Request $request)
    {
        $payments = Payment::where([
            ['user_id', '=', $request->user()->user_id],
            ['status', '=', 'paid'],
        ])->selectRaw('year(created_at) year, monthname(created_at) month, sum(amount) amount')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();

        return $payments;
    }

    static function transactionsByYear(Request $request)
    {
        $payments = Payment::where([
            ['user_id', '=', $request->user()->user_id],
            ['status', '=', 'paid'],
        ])->selectRaw('year(created_at) year, monthname(created_at) month, sum(amount) amount')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();

        return $payments;
    }

    static function transactionsByDay(Request $request)
    {
        $payments = Payment::where([
            ['user_id', '=', $request->user()->user_id],
            ['status', '=', 'paid'],
        ])->selectRaw('year(created_at) year, monthname(created_at) month, day(created_at) date, dayname(created_at) day, sum(amount) amount')
        ->groupBy('year', 'month', 'date', 'day')
        ->orderBy('year', 'desc')
        ->get();
        return $payments;
    }

    static function allTransactions(Request $request)
    {
        $payments = Payment::where([
            ['user_id', '=', $request->user()->user_id],
            ['status', '=', 'paid'],
        ])->get();
        return $payments;
    }

    //Equitel Test Callback
    public function equitelTestCallback(Request $request)
    {
        $response = json_decode($request->getContent());
        Log::info("EQUITEL CALLBACK====" . json_encode($response));
        $reference = $response->Reference;
        if ($response->StatusCode === "2" || $response->StatusCode === "3") {
            Payment::query()->where("reference", $reference)->update([
                "transaction_id" => $response->AdditionalParameters->TelcoReference,
                "transaction_date" => Carbon::now()->toDateTimeString(),
                "status" => "paid"
            ]);

            $payment = Payment::where("reference", $reference)->first();

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
    }

    //Equitel Callback
    public function equitelCallback(Request $request)
    {
        $this->equitelTestCallback($request);// Same Implementation As Test
    }

    public function initiateEquityPaybill(InitiatePaymentRequest $request){
        //equity
        $equity = new EquityService();
        return $equity->initiatePaybillPayment($request);
    }

}
