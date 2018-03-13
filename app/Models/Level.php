<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
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
