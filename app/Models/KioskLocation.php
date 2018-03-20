<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KioskLocation extends Model
{
    // relationship
    function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
