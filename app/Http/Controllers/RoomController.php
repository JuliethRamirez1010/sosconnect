<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Room::query()->orderBy('number')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'number' => ['required', 'string', 'max:40', 'unique:rooms,number'],
            'floor' => ['nullable', 'string', 'max:40'],
            'beds' => ['required', 'array', 'min:1', 'max:12'],
            'beds.*' => ['required', 'string', 'max:20', 'distinct:ignore_case'],
        ], [
            'number.unique' => 'Esta habitación ya está registrada.',
            'number.required' => 'Escribe el número o nombre de la habitación.',
            'beds.*.required' => 'Escribe un identificador para cada cama.',
            'beds.*.distinct' => 'Cada cama debe tener un identificador diferente.',
        ]);

        $room = Room::create($data);

        return response()->json(['ok' => true, 'room' => $room], 201);
    }
}
