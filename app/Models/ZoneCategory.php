<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneCategory extends Model
{
    // relationship
    function zones()
    {
        return $this->hasMany(Zone::class, 'zone_category_id');
    }

}
