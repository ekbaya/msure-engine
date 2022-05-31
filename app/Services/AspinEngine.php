<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Class AspinEngine.
 */
class AspinEngine
{
    private function getAccessToken($identifier)
    {
        $token = Cache::get($identifier . '_aspin_engine_token');
        if (is_null($token)) {
            $basic_token = base64_encode(config('app.aspinengine.client_id') . ':' . config('app.aspinengine.client_secret'));
            $username = config('app.aspinengine.username');
            $password = config('app.aspinengine.password');
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $basic_token
            ])
                ->withoutVerifying()
                ->post('https://engine.staging.aspin-inclusivity.com/oauth/token?grant_type=password&scope=all&username=' . $username . '&password=' . $password);
            if ($response->successful()) {
                Log::info('==ASPIN TOKEN==' . $response);
                $token = $response->json('access_token');
                Cache::put($identifier . '_aspin_engine_token', $token, $response->json('expires_in') - 10);
            } else {
                Log::info('==ERROR==' . $response);
                $response->throw();
            }
        }


        return $token;
    }

    //**************************CUSTOMER MANAGEMENT****************************************/

    //register customer(we will pass user model through observers)
    public function registerCustomer(User $user): mixed
    {
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/customers';
        $payload = [
            "full_name" => $user->name,
            "msisdn" => "00".$user->phone,
            "first_name" => $user->surname,
            "partner_guid" => config('app.aspinengine.partner_guid'),
            "display_language" => $user->display_language,
            "national_id" => $user->national_id,
            "beneficiary_msisdn" => "00".$user->beneficiary_phone,
            "beneficiary_name" => $user->beneficiary_name,
            "date_of_birth" => $user->date_of_birth,
            "external_identifier" => $user->ntsa_number,
            "account_number" => "00".$user->phone,
            "account_type" => $user->account_type,
            "branch_code" => $user->branch_code,
            "registration_channel" => $user->registration_channel
        ];
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->post($url, $payload);
        Log::info($response->body());
        return $response->json();
    }

    //get customer status{We are going to pass user phone}
    public function getCustomerStatus(): mixed
    {
        $phone = "00271603773356";
        $partner = config('app.aspinengine.partner_guid');
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/customers/' . $phone . '/status?partner=' . $partner;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->get($url);
        Log::info($response->body());
        return $response->json();
    }

    //update Customer
    public function updateCustomer(): mixed
    {
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/customers';
        $payload = [
            "guid" => "0066ed36a490469488721b11155b5ec2",
            "full_name" => "Bar",
            "msisdn" => "00271603773356",
            "first_name" => "Foo",
            "partner_guid" => "demo",
            "display_language" => "fr",
            "national_id" => "national_id",
            "beneficiary_msisdn" => "002250700000001",
            "beneficiary_name" => "beneficiary name",
            "date_of_birth" => "2000-12-03"
        ];
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->put($url, $payload);
        Log::info($response->body());
        return $response->json();
    }

    //serach Customers
    public function searchCustomers(): mixed
    {
        $phone = "00271603773356";
        $name = "Foo";
        $partner = config('app.aspinengine.partner_guid');;
        $size = "10";
        $page = "0";
        $identifier = config('app.aspinengine.identifier'); //Identi//Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/customers/find?msisdn=' . $phone . '&name=' . $name . '&partner=' . $partner . '&size=' . $size . '&page=' . $page;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->get($url);
        Log::info($response->body());
        return $response->json();
    }

    //**************************PRODUCTS****************************************/
    //get products
    public function getAllProducts(): mixed
    {
        $partner = config('app.aspinengine.partner_guid');
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/products?partner=' . $partner;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->get($url);
        Log::info($response->body());
        return $response->json();
    }
}
