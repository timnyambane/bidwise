<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'town',
        'location',
        'eastings',
        'region',
        'longitude',
        'postcode',
        'latitude',
        'northings',
    ];
}
