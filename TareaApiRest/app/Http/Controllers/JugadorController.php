<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Club;
use Illuminate\Http\Request;
use App\Http\Resources\JugadorResource;

class JugadorController extends Controller
{
    public function index(Request $request)
    {
        $query = Jugador::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', '=', $request->input('nombre'));
        }

        if ($request->filled('dorsal')) {
            $operator = $request->input('operator_dorsal', '=');
            $query->where('dorsal', $operator, $request->input('dorsal'));
        }

        if ($request->filled('fecha_nacimiento')) {
             $operator = $request->input('operator_fecha', '=');
             $query->where('fecha_nacimiento', $operator, $request->input('fecha_nacimiento'));
        }

        return JugadorResource::collection($query->paginate(15));
    }

    public function show($id)
    {
        $jugador = Jugador::findOrFail($id);
        return new JugadorResource($jugador);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'dorsal' => 'required|numeric',
            'ciudad_nacimiento' => 'required|string',
            'pais_nacimiento' => 'required|string',
            'fecha_nacimiento' => 'required|date_format:Y-m-d H:i:s',
            'posicion' => 'required|in:PT,LD,LI,DF,MC,MD,MI,ED,EI,DC',
            'club_id' => 'required|integer|exists:clubs,id',
        ]);

        $jugador = Jugador::create($validatedData);
        return response()->json(new JugadorResource($jugador), 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string',
            'dorsal' => 'sometimes|required|numeric',
            'ciudad_nacimiento' => 'sometimes|required|string',
            'pais_nacimiento' => 'sometimes|required|string',
            'fecha_nacimiento' => 'sometimes|required|date_format:Y-m-d H:i:s',
            'posicion' => 'sometimes|required|in:PT,LD,LI,DF,MC,MD,MI,ED,EI,DC',
            'club_id' => 'sometimes|required|integer|exists:clubs,id',
        ]);

        $jugador = Jugador::findOrFail($id);
        $jugador->update($validatedData);

        return new JugadorResource($jugador);
    }

    public function destroy($id)
    {
        $jugador = Jugador::findOrFail($id);
        $jugador->delete();

        return response()->json(null, 204);
    }

    public function bulkStore(Request $request)
    {
        $validatedData = $request->validate([
            '*.nombre' => 'required|string',
            '*.dorsal' => 'required|numeric',
            '*.ciudad_nacimiento' => 'required|string',
            '*.pais_nacimiento' => 'required|string',
            '*.fecha_nacimiento' => 'required|date_format:Y-m-d H:i:s',
            '*.posicion' => 'required|in:PT,LD,LI,DF,MC,MD,MI,ED,EI,DC',
            '*.club_id' => 'required|integer|exists:clubs,id',
        ]);

        Jugador::insert($validatedData);

        return response()->json(['message' => 'Jugadores creados exitosamente'], 201);
    }
}