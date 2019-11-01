<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = ['title'];

    public function beer()
    {
        return $this->hasMany(Beer::class);
    }
}
