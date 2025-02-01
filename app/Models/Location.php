<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['town', 'latitude', 'longitude', 'postcode'];

    public function jobs()
    {
        return $this->hasMany(JobPost::class);
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
