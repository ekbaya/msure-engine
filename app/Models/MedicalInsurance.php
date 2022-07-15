<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class MedicalInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'reference',
    ];

    protected $hidden = [
        'id',
        'amount',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($account) {
            if (empty($account->account_id)) {
                $account->account_id = Str::uuid();
            }
        });
    }
}
