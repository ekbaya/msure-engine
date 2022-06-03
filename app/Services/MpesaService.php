<?php

namespace App\Services;

use App\Http\Requests\PaymentRequest;
use App\Http\Requests\PurchasePolicyRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Class MpesaService.
 */
class MpesaService
{
    private function getAccessToken($identifier)
    {
        $token = Cache::get($identifier.'_access_token');
        if(is_null($token)) {
            $response = Http::withBasicAuth(config('app.'.$identifier.'.consumer_key'), config('app.'.$identifier.'.consumer_secret'))
                ->withoutVerifying()
                ->get('https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

            if ($response->successful()) {
                $token = $response->json('access_token');
                Cache::put($identifier.'_access_token', $token, $response->json('expires_in') - 10);
            } else {
                Log::info($response->reason());
                $response->throw();
            }
        }

        return $token;
    }

     /**
     * @param string $identifier
     * @param string $amount
     * @param string $msisdn
     * @param string $accRef
     * @param string $description
     * @return mixed
     * @throws RequestException
     */
    public function stkPush(PurchasePolicyRequest $paymentRequest): mixed
    {
        $identifier = config('app.msure.identifier');
        $url = config('app.mpesa.base_url'). 'mpesa/stkpush/v1/processrequest';
        $timestamp = Carbon::now()->format('YmdHis');
        $password = base64_encode(config('app.'.$identifier.'.short_code').config('app.'.$identifier.'.pass_key').$timestamp);
        $payload = [
            "BusinessShortCode"=> config('app.'.$identifier.'.short_code'),
            "Password"=> $password,
            "Timestamp"=> $timestamp,
            "TransactionType"=> "CustomerPayBillOnline",
            "Amount"=> $paymentRequest->amount,
            "PartyA"=> $paymentRequest->user()->phone,
            "PartyB"=> config('app.'.$identifier.'.short_code'),
            "PhoneNumber"=> $paymentRequest->user()->phone,
            "CallBackURL"=> config('app.'.$identifier.'.callback_url'),
            "AccountReference"=> $paymentRequest->product_code,
            "TransactionDesc"=> "Paying for an insurance policy"
        ];
        $response = Http::withToken($this->getAccessToken($identifier))
            ->withoutVerifying()
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url, $payload);
        Log::info($response->body());
        if (!$response->successful()) $response->throw();
        return $response->json();
    }
}
