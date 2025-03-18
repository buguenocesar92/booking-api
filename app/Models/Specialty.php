<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = ['name'];

    // Si lo deseas, define la relación con profesionales
    public function professionals()
    {
        return $this->hasMany(Professional::class);
    }
}
