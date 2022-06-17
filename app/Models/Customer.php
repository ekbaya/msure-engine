<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'beneficiary_phone',
        'phone',
        'email',
        'national_id',
        'location',
        'beneficiary_name',
        'date_of_birth',
        'ntsa_number',
        'display_language'
    ];

    protected $hidden = [
        'id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (empty($customer->customer_id)) {
                $customer->customer_id = Str::uuid();
            }
        });
    }
}
