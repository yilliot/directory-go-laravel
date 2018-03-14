<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    // scope
    function scopeIsActivated()
    {
        return $this->where('is_activated', true);
    }
    // relationship
    function areas()
    {
        return $this->hasMany(Area::class, 'level_id');
    }
    function zones()
    {
        return $this->hasMany(Zone::class, 'level_id');
    }
    function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

}
