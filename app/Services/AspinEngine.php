<?php

namespace App\Services;

use App\Http\Requests\InitiateClaimRequest;
use App\Http\Requests\PurchasePolicyRequest;
use App\Models\Payment;
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
    public function registerCustomer(User $user)
    {
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/customers/register';
        $payload = [
            "full_name" => $user->name,
            "msisdn" => $user->phone,
            "first_name" => $user->surname,
            "partner_guid" => config('app.aspinengine.partner_guid'),
            "display_language" => $user->display_language,
            "national_id" => $user->national_id,
            "beneficiary_msisdn" => $user->beneficiary_phone,
            "beneficiary_name" => $user->beneficiary_name,
            "date_of_birth" => $user->date_of_birth,
            "external_identifier" => $user->ntsa_number,
            "account_number" => $user->phone,
            "account_type" => "user",
            "branch_code" => "1072",
            "registration_channel" => $user->registration_channel
        ];

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier), 'content-type' => 'application/json'])
            ->withoutVerifying()
            ->post($url, $payload);

        $res = $response->json();
        $resp = $res['customer'];

        
        if ($resp['guid']) {
            Log::info("SUCCESS".json_encode($resp['guid']));
             $guid = $resp['guid'];
            // update user guid from ASPIN ENGINE
            User::query()->where('email', $user->email)->update([
                'guid'=>$guid
            ]);
        }

        Log::info('REGISTER_USER=====' . $response->body()); 
    }

    //get customer status{We are going to pass user phone}
    public function getCustomerStatus(User $user): mixed
    {
        $phone = $user->phone; //e.g 00254712695820
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
    public function updateCustomer(User $user): mixed
    {
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/customers';
        $payload = [
            "guid" => $user->guid,
            "full_name" => $user->name,
            "msisdn" => $user->phone,
            "first_name" => $user->surname,
            "partner_guid" => config('app.aspinengine.partner_guid'),
            "display_language" => $user->display_language,
            "national_id" => $user->national_id,
            "beneficiary_msisdn" => $user->beneficiary_phone,
            "beneficiary_name" => $user->beneficiary_name,
            "date_of_birth" => $user->date_of_birth,
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
        $phone = "271603773356";
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

    //Buy policy
    public function buyPolicy(Payment $payment)
    {
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/products/buy?partner=' . config('app.aspinengine.partner_guid');
        $payload = [
            "amount_in_cents" => ($payment->Amount * 100), //converting to cents
            "channel" => 'ApiClient',
            "msisdn" => $payment->PhoneNumber,
            "product_code" => $payment->PolicyGuid,
        ];
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->post($url, $payload);
        Log::info('BUY_POLICY=====' . $response->body());
        return $response->json();
    }

    //get customer policy
    public function getCustomerPolicy(User $user): mixed
    {
        $phone = $user->phone; //e.g 254712695820
        $partner = config('app.aspinengine.partner_guid');
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/policies/' . $phone . '/paid?partner=' . $partner;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->get($url);
        Log::info($response->body());
        return $response->json();
    }

    //get customer active policy
    public function getCustomerActivePolicy(User $user): mixed
    {
        $phone = $user->phone; //e.g 254712695820
        $partner = config('app.aspinengine.partner_guid');
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/policies/customer/' . $phone . '?partner=' . $partner;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->get($url);
        Log::info($response->body());
        return $response->json();
    }

    //cancel  policy
    public function cancelPolicy(string $id): mixed
    {
        $partner = config('app.aspinengine.partner_guid');
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/policies/' . $id . '?partner=' . $partner;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->delete($url);
        Log::info($response->body());
        return $response->json();
    }

    //**************************Claims****************************************/
    //get customer claims
    public function getCustomerClaims(User $user): mixed
    {
        $phone = $user->phone; //e.g 254712695820
        $partner = config('app.aspinengine.partner_guid');
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/claims/customer/' . $phone . '?partner=' . $partner;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->get($url);
        Log::info($response->body());
        return $response->json();
    }

    //get claim details
    public function getClaimDetails(string $id): mixed
    {
        $partner = config('app.aspinengine.partner_guid');
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/claims/' . $id . '?partner=' . $partner;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->get($url);
        Log::info($response->body());
        return $response->json();
    }

    //Initiate Claim
    public function initiateClaim(InitiateClaimRequest $request)
    {
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/claims?partner=' . config('app.aspinengine.partner_guid');
        $payload = [
            "type" => $request->type,
            "relation_to_main_member" => $request->relation_to_main_member,
            "customer_guid" => $request->user()->guid,
            "hospital_admission_date" => $request->hospital_admission_date,
            "hospital_discharge_date" => $request->hospital_discharge_date,
        ];
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->post($url, $payload);
        Log::info('CLAIM_REQUEST=====' . $response->body());
        return $response->json();
    }

    //Add Payments
    public function addPayments(Payment $payment)
    {
        $identifier = config('app.aspinengine.identifier'); //Identifier for Msure
        $url = config('app.aspinengine.base_url') . '/products?partner=' . config('app.aspinengine.partner_guid');
        $payload = [
            "amount_in_cents" => ($payment->Amount * 100), //converting to cents
            "channel" => 'ApiClient',
            "status" => 'Succeeded',
            "mno_reference" => $payment->MpesaReceiptNumber,
            "policy_guid" => $payment->PolicyGuid,
            "effected_at" => $payment->TransactionDate,
        ];
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->getAccessToken($identifier)])
            ->withoutVerifying()
            ->post($url, $payload);
        Log::info('ADD_PAYMENTS=====' . $response->body());
        return $response->json();
    }
}
