<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JugadorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'dorsal' => $this->dorsal,
            'ciudad_nacimiento' => $this->ciudad_nacimiento,
            'pais_nacimiento' => $this->pais_nacimiento,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'posicion' => $this->posicion,
            'club_id' => $this->club_id,
        ];
    }
}
