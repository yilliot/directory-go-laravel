<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
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
    function categories()
    {
        return $this->belongsToMany(Category::class, 'area_categories');
    }

}
