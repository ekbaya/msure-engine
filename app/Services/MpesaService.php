<?php

namespace App\Services;

use App\Http\Requests\PurchasePolicyRequest;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Safaricom\Mpesa\Mpesa;

/**
 * Class MpesaService.
 */
class MpesaService
{
    public function stkPush(PurchasePolicyRequest $paymentRequest): mixed
    {
        $mpesa = new Mpesa();
        $stkPushSimulation = $mpesa->STKPushSimulation(
            config('app.msure.short_code'),
            config('app.msure.pass_key'),
            "CustomerPayBillOnline",
            $paymentRequest->amount,
            '254' . substr($paymentRequest->mobile, -9),
            config('app.msure.short_code'),
            '254' . substr($paymentRequest->mobile, -9),
            config('app.msure.callback_url'),
            "Msure Individul",
            "Purchasing policy",
            "Ok"
        );

        $response = json_decode($stkPushSimulation);
        Log::info("RES==========".$stkPushSimulation);
        $payment =  Payment::create(
            [
                "MerchantRequestID" => $response->MerchantRequestID,
                "CheckoutRequestID" => $response->CheckoutRequestID,
                "ResponseCode" => $response->ResponseCode,
                "ResponseDescription" => $response->ResponseDescription,
                "CustomerMessage" => $response->CustomerMessage,
                "Amount" => $paymentRequest->amount,
                "PhoneNumber" => $paymentRequest->user()->phone,
                "PolicyGuid" => $paymentRequest->policy_id,
                "UserId" => $paymentRequest->user()->user_id
            ]
        );
        return response()->json([
            'status' => 0,
            'success' => true,
            'message' => 'Check your phone for MPESA pop up to enter PIN'
        ]);
    }
}
