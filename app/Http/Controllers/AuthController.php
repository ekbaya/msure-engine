<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Models\Customer;
use App\Models\OTPRequest;
use App\Models\User;
use App\Services\AspinEngine;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private function getToken($user): JsonResponse
    {
        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    public function register(RegisterUserRequest $request): JsonResponse
    {
        $request->merge([
            'phone' => '254' . substr($request->get('phone'), -9) //254712695820
        ]);

        $payload = $request->all();

        if ($request->has('password'))
            $payload['password'] = Hash::make($request->get('password'));

        $user = User::create($payload);

        $u = $user->fresh();

        $request->merge(['user_id' => $u->user_id]);
        //create Customer
        $customerpayload = $request->all();
        $customer = Customer::create($customerpayload);
        $c = $customer->fresh();
        //Create new user to ASPIN ENGINE
        try {
            $engine = new AspinEngine();
            $engine->registerCustomer($c);
        } catch (Exception $e) {
            Log::info('==Failed To Register=='.$e->getMessage());
        }

        return $this->getToken($user);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $fieldType = filter_var($request->get('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        if (!$request->has('password') && $fieldType == 'phone') {

            $mobile = '254' . substr($request->get('username'), -9);

            $user = User::query()->where('phone', $mobile)->first();

            if (!is_null($user)) {
                OTPRequest::query()->where('phone', $user->mobile)->delete();

                OTPRequest::query()->create(
                    ['phone' => $user->mobile, 'otp' => rand(100, 9999)]
                );

                return response()->json(['message' => 'An OTP has been sent to ' . $user->mobile . '. Use it to verify your phone number.']);
            } else {
                return response()->json(['message' => 'User with mobile ' . $mobile . ' is not registered.'], 404);
            }
        }

        if (Auth::attempt(array($fieldType => $request->get('username'), 'password' => $request->get('password')))) {
            $user = User::query()->where($fieldType, $request->get('username'))->firstOrFail();
            return $this->getToken($user);
        }

        return response()->json([
            'message' => 'Wrong username or password'
        ], 401);
    }


    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
    {
        $otpRequest = OTPRequest::query()->where('phone', '254' . substr($request->get('phone'), -9))->first();
        if (!is_null($otpRequest) && $otpRequest->otp == $request->get('otp')) {
            $otpRequest->delete();
            if ($request->has('login')) {
                $user = User::query()->where('phone', '254' . substr($request->get('phone'), -9))->first();

                if (is_null($user))
                    return response()->json(['message' => 'OTP Validated successfully. User with mobile 254' . substr($request->get('mobile'), -9) . ' found.'], 404);

                return $this->getToken($user);
            }
            return response()->json(['message' => 'OTP Validated successfully.']);
        }
        return response()->json(['message' => 'Unable to verify your otp.'], 400);
    }
}
