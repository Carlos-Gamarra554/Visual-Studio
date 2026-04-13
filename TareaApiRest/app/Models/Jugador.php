<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'dorsal', 'ciudad_nacimiento', 'pais_nacimiento', 'fecha_nacimiento', 'posicion', 'club_id'];

    public function club() {
        return $this->belongsTo(Club::class);
    }
}
