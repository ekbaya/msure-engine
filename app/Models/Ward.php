<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    public function subCounty()
    {
        return $this->belongsTo(SubCounty::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
