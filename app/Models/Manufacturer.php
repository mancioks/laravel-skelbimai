<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    public function models()
    {
        return $this->hasMany(\App\Models\Model::class, 'manufacturer_id', 'id');
    }
}
