<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'direccion_estadio', 'presidente', 'color_equipacion', 'ciudad', 'pais', 'division', 'fecha_creacion'];

    public function jugadores() {
        return $this->hasMany(Jugador::class);
    }
}