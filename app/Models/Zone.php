<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    // relationship
    function zoneCategory()
    {
        $this->belongsTo(ZoneCategory::class, 'zone_category_id');
    }
}
