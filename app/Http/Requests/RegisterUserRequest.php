<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required',
            'organization_id' => 'required',
            'surname' => 'required',
            'phone' => 'required|phone:KE|unique:users,phone',
            'email' => 'email|unique:users,email',
            'password' => 'required',
            'national_id' => 'required',
            'date_of_birth' =>  [
                'required',
                'before:-18 years'
            ],
            'location' => 'required',
            'ntsa_number' => 'required',
        ];
    }
}