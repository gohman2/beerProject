<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeBeer extends Model
{
    protected $fillable = ['title'];

    public function beer()
    {
        return $this->hasMany(Beer::class, 'type_id');
    }
}
