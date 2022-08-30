<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Payment extends Model
{
    use HasFactory, Notifiable, HasEvents;

    protected $fillable = [
        'reference',
        'amount',
        'phone',
        'policy_guid',
        'user_id'
    ];
}
