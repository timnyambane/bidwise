<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'user_id',
        'work_category_id',
        'service_id',
        'location_id',
        'title',
        'description',
        'urgency',
        'specificDate',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function workCategory()
    {
        return $this->belongsTo(WorkCategory::class);
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
