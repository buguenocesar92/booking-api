<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'image',
        'description', // Puedes agregar más campos si lo requieres.
        'user_id'
    ];

    // Si necesitas relaciones, por ejemplo con reservas:
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Relación: cada profesional pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
