<?php

namespace App\Services;

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
    public function getAccessToken($identifier)
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
            if ($response->successful()) {
                Log::info('==EQUITY RESPONSE==' . $response->getBody());
                $token = $response->json('access_token');
                Cache::put($identifier . '_equity_payments_token', $token, $response->json('expires_in') - 10);
            } else {
                Log::info('==ERROR==' . $response);
                $response->throw();
            }
        }

        return $token;
    }
}
