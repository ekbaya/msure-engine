<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
