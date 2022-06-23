<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Cover extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'amount',
        'reference',
    ];

    protected $hidden = [
        'id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cover) {
            if (empty($cover->cover_id)) {
                $cover->cover_id = Str::uuid();
            }
        });
    }
}
