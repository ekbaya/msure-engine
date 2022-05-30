<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|phone:KE|unique:users,mobile',
            'email' => 'email|unique:users,email',
            'password' => 'confirmed',
            'national_id' => 'required',
            'date_of_birth' => 'required',
            'beneficiary_phone' => 'required',
            'beneficiary_name' => 'required',
        ];
    }
}
