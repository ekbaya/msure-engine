<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterAccountRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    private function getToken($user): JsonResponse
    {
        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    public function create(RegisterAccountRequest $request)
    {
        //create user
        $request->merge([
            'phone' => '254' . substr($request->get('phone'), -9) //0712695820
        ]);

        $request->merge([
            'role' => 'merchant'
        ]);

        $payload = $request->all();

        if ($request->has('password'))
            $payload['password'] = Hash::make($request->get('password'));

        $user = User::create($payload);
        $user = $user->fresh();

        //creare client
        $clientRepository = app('Laravel\Passport\ClientRepository');
        $client = $clientRepository->create($user->id, $request->name, 'http://localhost/auth/callback');

        //fetch client {To Access Client Secret}
        $client = DB::table('oauth_clients')->where('id', $client->id)->first();

        //create Account to store merchant details
        $timestamp = Carbon::now()->toDateTimeString();
        $api_key = base64_encode($client->id . ':' . $client->secret . ':' . $timestamp);
        $request->merge(['user_id' => $user->user_id]);
        $request->merge(['api_key' => $api_key]);

        $payload = $request->all();
        Account::create($payload);

        return response()->json(
            [
                'success' => true,
                'status' => 0,
                'message' => 'Client created Successfully',
                'data' => [
                    'client_id' => $client->id,
                    'client_secret' => $client->secret,
                    'api_key' => $api_key
                ]
            ]
        );
    }


    public function authenticate(Request $request)
    {
        $clientId = $request->clientId;
        $clientSecret = $request->clientSecret;
        $username = $request->username;
        $password = $request->password;
        $apikey = $request->bearerToken();

        if (!$apikey) {
            return response()->json(["message" => "Unauthenticated."], Response::HTTP_UNAUTHORIZED);
        }

        try {
           //get account
        $account = Account::query()->where('api_key', $apikey)->firstOrFail();
        if (!$account) {
            return response()->json(["message" => "Unauthenticated."], Response::HTTP_UNAUTHORIZED);
        }
        } catch (\Throwable $th) {
            return response()->json(["message" => "No Accounts Found."], Response::HTTP_NOT_FOUND);
        }

        if (!Auth::attempt(array('email' => $username, 'password' => $password))) {
            return response()->json(["message" => "Unauthenticated."], Response::HTTP_UNAUTHORIZED);
        }
        //get user
        $user = User::query()->where('email', $username)->firstOrFail();

        //fetch client
        $client = DB::table('oauth_clients')->where([
            ['id', '=', $clientId],
            ['secret', '=', $clientSecret]
        ])->first();

        if (!$client) {
            return response()->json(["message" => "Unauthenticated."], Response::HTTP_UNAUTHORIZED);
        }

        if (!($account->user_id == $user->user_id)) {
            return response()->json(["message" => "Unauthenticated."], Response::HTTP_UNAUTHORIZED);
        }

        return $this->getToken($user);
    }
}
