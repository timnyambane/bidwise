<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'customer_id',
        'category_id',
        'service_id',
        'location_id',
        'title',
        'desc',
        'urgency',
        'property',
        'standard',
        'date',
    ];

    protected $casts = [
        'standard' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
