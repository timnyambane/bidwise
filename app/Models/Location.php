<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'location',
        'town',
        'country',
        'region',
        'latitude',
        'longitude',
        'postcode'
    ];

    public function jobs()
    {
        return $this->hasMany(JobPost::class);
    }

    public function businesses()
    {
        return $this->belongsToMany(Business::class);
    }
}
