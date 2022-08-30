<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Class EquityService.
 */
class EquityService
{
    public function getAccessToken($identifier)
    {
        $token = Cache::get($identifier . '_equity_payments_token');

        if (is_null($token)) {
            $payload = [
                'form_params' => [
                    "client_secret" => config('app.equity.client_secret'),
                    "client_id" => config('app.equity.client_id'),
                    "grant_type" => config('app.equity.grant_type'),
                ]];

            Log::info('==GRANT-TYPE==' .config('app.equity.grant_type'));

            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded'
            ])
                ->withoutVerifying()
                ->post(config('app.equity.base_url') . '/v2.1/oauth/token', $payload);
            if ($response->successful()) {
                Log::info('==EQUITY TOKEN==' . $response);
                $token = $response->json('access_token');
                Cache::put($identifier . '_equity_payments_token', $token, $response->json('expires_in') - 10);
            } else {
                Log::info('==ERROR==' . $response);
                $response->throw();
            }
        }
    }
}
