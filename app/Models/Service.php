<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['category_id', 'name', 'active'];

    public function category()
    {
        return $this->belongsTo(WorkCategory::class);
    }

    public function businesses()
    {
        return $this->belongsToMany(Business::class);
    }
}
