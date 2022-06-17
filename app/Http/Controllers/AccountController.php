<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterAccountRequest;
use App\Models\Account;
use App\Models\User;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                'success'=>true,
                'status' =>0,
                'message'=>'Client created Successfully',
                'data'=>[
                    'client_id'=>$client->id,
                    'client_secret'=>$client->secret,
                    'api_key'=>$api_key
                ]
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
