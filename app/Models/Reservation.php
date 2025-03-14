<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'name',
        'email',
        'date',
        'time',
        'message'
    ];

    // Relación con Professional
    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
}
