<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function areas()
    {
        return $this->belongsToMany(Area::class, 'area_categories');
    }
}
