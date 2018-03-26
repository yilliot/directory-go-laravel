<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kiosk extends Model
{
    protected $table = 'kiosk_locations';

    // relationship
    function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
