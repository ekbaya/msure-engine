<?php

namespace App\Services;

use App\Http\Requests\PurchasePolicyRequest;
use App\Models\Payment;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

/**
 * Class EquityService.
 */
class EquityService
{
    private function getAccessToken($identifier)
    {
        $token = Cache::get($identifier . '_equity_payments_token');
        if (is_null($token)) {
            $client = new Client();
            $headers = [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ];
            $payload = [
                'form_params' => [
                    "client_secret" => config('app.equity.client_secret'),
                    "client_id" => config('app.equity.client_id'),
                    "grant_type" => config('app.equity.grant_type'),
                ]
            ];

            $request = new Request('POST', config('app.equity.base_url') . '/v2.1/oauth/token', $headers);
            $response = $client->sendAsync($request, $payload)->wait();
            if ($response->getStatusCode() === 200) {
                Log::info('==EQUITY RESPONSE==' . $response->getBody());
                $token = json_decode($response->getBody())->access_token;
                $expires_in = json_decode($response->getBody())->expires_in;
                Cache::put($identifier . '_equity_payments_token', $token, $expires_in - 10);
            } else {
                Log::info('==ERROR==' . $response->getBody());
                Log::info('==STATUS CODE==' . $response->getStatusCode());
                $response->throw();
            }
        }

        return $token;
    }

    public function initiatePayment(PurchasePolicyRequest $purchasePolicyRequest)
    {
        $client = new Client();
        $callbackUrl = config('app.equity.callback_url');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getAccessToken('equity'),
        ];
        $refrence = 'REF' . Carbon::now()->timestamp;

        Payment::create(
            [
                "reference" => $refrence,
                "amount" => $purchasePolicyRequest->amount,
                "phone" => $purchasePolicyRequest->mobile,
                "policy_guid" => $purchasePolicyRequest->policy_id,
                "user_id" => $purchasePolicyRequest->user()->user_id
            ]
        );
        $body = array(
            "phoneNumber" => '254723558427',
            "reference" => $refrence,
            "amount" => $purchasePolicyRequest->amount,
            "telco" => "SAF",
            "countryCode" => "KE",
            "callBackUrl" => $callbackUrl,
            "errorCallBackUrl" => $callbackUrl,
        );
        $request = new Request('POST', config('app.equity.base_url') . '/v1/stkussdpush/stk/initiate', $headers, json_encode($body));
        $response = $client->sendAsync($request)->wait();
        Log::info('==PAYMENT RESPONSE==' . $response->getBody());

        return response()->json([
            'status' => 0,
            'success' => true,
            'message' => 'Check your phone for MPESA pop up to enter PIN',
            'REF' => $refrence
        ]);
    }
}
