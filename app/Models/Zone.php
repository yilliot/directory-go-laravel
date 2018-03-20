<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    // relationship
    function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }
    function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
    // relationship
    function zoneCategory()
    {
        return $this->belongsTo(ZoneCategory::class, 'zone_category_id');
    }
}
