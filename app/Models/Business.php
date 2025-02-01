<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'user_id',
        'location_id',
        'category_id',
        'phone',
        'name',
        'website',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function category()
    {
        return $this->belongsTo(WorkCategory::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function canQuoteJob(JobPost $job)
    {
        return $this->location_id == $job->location_id &&
            $this->category_id == $job->work_category_id &&
            $this->services->contains($job->service_id);
    }
}
