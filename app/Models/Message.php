<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
        'subject',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($message) {
            //
        });
    }
}
