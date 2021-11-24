<?php

namespace App\Http\Controllers;

use App\Models\mGenre;
use App\Models\mMovie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index()
    {
        $genre = mGenre::all();
        $response = [
            'pesan' => "Semua Data Genre",
            'data' => $genre
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'genre' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        try {
            $genre = mGenre::create($request->all());
            $response = [
                'pesan' => "Data Genre Dibuat",
                'data' => $genre,
            ];

            return response()->json($response, 201);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Gagal " . $e->errorInfo,
            ]);
        }
    }

    public function show($id)
    {
        $genre = mGenre::findOrFail($id);
        $response = [
            'pesan' => "Data  dengan id " . $id,
            'data' => $genre,
        ];
        return response()->json($response, 200);
    }

    public function update(Request $request, $id)
    {
        $genre = mGenre::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'genre' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        try {
            $genre->update($request->all());
            $response = [
                'pesan' => "Data Genre Diperbarui",
                'data' => $genre,
            ];

            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Gagal " . $e->errorInfo,
            ]);
        }
    }

    public function destroy($id)
    {
        $genre = mGenre::findorFail($id);
        try {
            $genre->delete();
            $response = [
                'pesan' => "Data Genre Terhapus"
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Gagal " . $e->errorInfo,
            ]);
        }
    }
}
