<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    // relationship
    function levels()
    {
        return $this->hasMany(Level::class, 'block_id', 'id');
    }
}
