<?php

namespace App\Http\Controllers;

use App\Models\mMovie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{

    public function index()
    {
        $movie = mMovie::all();
        $response = [
            'pesan' => "Semua Data Movie",
            'data' => $movie
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_movie' => 'required',
            'rilis' => 'required',
            'id_sutradara' => 'required',
            'durasi' => 'required',
            'asal' => 'required',
            'produksi' => 'required',
            'pemain' => 'required',
            'id_genre' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        try {
            $movie = mMovie::create($request->all());
            $response = [
                'pesan' => "Data Movie Dibuat",
                'data' => $movie,
            ];

            return response()->json($response, 201);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Gagal " . $e->errorInfo
            ]);
        }
    }

    public function show($id)
    {
        $movie = mMovie::findOrFail($id);
        $response = [
            'pesan' => "Data  dengan id " . $id,
            'data' => $movie,
        ];
        return response()->json($response, 200);
    }

    public function update(Request $request, $id)
    {
        $movie = mMovie::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'judul_movie' => 'required',
            'rilis' => 'required',
            'id_sutradara' => 'required',
            'durasi' => 'required',
            'asal' => 'required',
            'produksi' => 'required',
            'pemain' => 'required',
            'id_genre' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        try {
            $movie->update($request->all());
            $response = [
                'pesan' => "Data Movie Diperbarui",
                'data' => $movie,
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
        $movie = mMovie::findorFail($id);
        try {
            $movie->delete();
            $response = [
                'pesan' => "Data Movie Terhapus"
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Gagal " . $e->errorInfo,
            ]);
        }
    }
}
