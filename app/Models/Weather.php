<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'country_id',
        'state_id',
        'city_id',
        'latitude',
        'longitude',
        'temp',
        'expires_at'
    ];
}
