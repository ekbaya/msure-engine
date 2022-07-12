<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ward_id', 'latitude', 'longitude', 'leader_name', 'leader_phone', 'daily_contribution'];

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function riders()
    {
        return $this->hasMany(Customer::class);
    }
}
