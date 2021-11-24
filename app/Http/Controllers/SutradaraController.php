<?php

namespace App\Http\Controllers;

use App\Models\mSutradara;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SutradaraController extends Controller
{

    public function index()
    {
        $sutradara = mSutradara::all();
        $response = [
            'pesan' => "Semua Data Sutradara",
            'data' => $sutradara
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'ttl' => 'required',
            'pendidikan' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        try {
            $sutradara = mSutradara::create($request->all());
            $response = [
                'pesan' => "Data Sutradara Dibuat",
                'data' => $sutradara,
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
        $sutradara = mSutradara::findOrFail($id);
        $response = [
            'pesan' => "Data  dengan id " . $id,
            'data' => $sutradara,
        ];
        return response()->json($response, 200);
    }

    public function update(Request $request, $id)
    {
        $sutradara = mSutradara::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'ttl' => 'required',
            'pendidikan' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        try {
            $sutradara->update($request->all());
            $response = [
                'pesan' => "Data Sutradara Diperbarui",
                'data' => $sutradara,
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
        $sutradara = mSutradara::findorFail($id);
        try {
            $sutradara->delete();
            $response = [
                'pesan' => "Data Sutradara Terhapus"
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Gagal " . $e->errorInfo,
            ]);
        }
    }
}
