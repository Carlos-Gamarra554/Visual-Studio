<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
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
            'direccion_estadio' => $this->direccion_estadio,
            'presidente' => $this->presidente,
            'color_equipacion' => $this->color_equipacion,
            'ciudad' => $this->ciudad,
            'pais' => $this->pais,
            'division' => $this->division,
            'fecha_creacion' => $this->fecha_creacion,
            
            // Solo adjunta los jugadores si el controlador hizo un "with('jugadores')"
            'jugadores' => JugadorResource::collection($this->whenLoaded('jugadores')),
        ];
    }
}
