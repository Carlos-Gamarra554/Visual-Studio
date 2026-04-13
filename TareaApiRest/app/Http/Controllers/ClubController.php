<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use App\Http\Resources\ClubResource;

class ClubController extends Controller
{
    public function index(Request $request)
    {
        $query = Club::query();

        if ($request->boolean('jugadores')) {
            $query->with('jugadores');
        }

        if ($request->filled('nombre')) {
            $query->where('nombre', '=', $request->input('nombre'));
        }
        
        if ($request->filled('fecha_creacion')) {
            $operator = $request->input('operator', '=');
            $query->where('fecha_creacion', $operator, $request->input('fecha_creacion'));
        }

        return ClubResource::collection($query->paginate(10));
    }

    public function show($id, Request $request)
    {
        $query = Club::query();

        if ($request->boolean('jugadores')) {
            $query->with('jugadores');
        }

        $club = $query->findOrFail($id);
        
        return new ClubResource($club);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'direccion_estadio' => 'required|string',
            'presidente' => 'required|string',
            'color_equipacion' => 'required|string',
            'ciudad' => 'required|string',
            'pais' => 'required|string',
            'division' => 'required|in:1ª División,2ª División,1ª RFEF,2ª RFEF,3ª RFEF',
            'fecha_creacion' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $club = Club::create($validatedData);

        return response()->json(new ClubResource($club), 201);
    }

    public function update(Request $request, $id)
    {
         $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string',
            'direccion_estadio' => 'sometimes|required|string',
            'presidente' => 'sometimes|required|string',
            'color_equipacion' => 'sometimes|required|string',
            'ciudad' => 'sometimes|required|string',
            'pais' => 'sometimes|required|string',
            'division' => 'sometimes|required|in:1ª División,2ª División,1ª RFEF,2ª RFEF,3ª RFEF',
            'fecha_creacion' => 'sometimes|required|date_format:Y-m-d H:i:s',
        ]);

        $club = Club::findOrFail($id);
        $club->update($validatedData);

        return new ClubResource($club);
    }

    public function destroy($id)
    {
        $club = Club::findOrFail($id);
        $club->delete();

        return response()->json(null, 204);
    }
}