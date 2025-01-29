<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkCategory extends Model
{
    protected $fillable = ['name', 'active'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
