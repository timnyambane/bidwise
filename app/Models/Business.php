<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'user_id',
        'location',
        'phone',
        'name',
        'website',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function workCategory()
    {
        return $this->belongsTo(WorkCategory::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
