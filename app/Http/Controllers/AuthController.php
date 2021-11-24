<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([

            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => bcrypt($validator['password']),
        ]);

        $token = $user->createToken($validator['name'])->plainTextToken;
        return response()->json([
            'sukses' => true,
            'pesan' => 'Sukses',
            // 'user' => $user,
            'token' => $token
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'sukses' => false,
                'pesan' => 'Unauthorized',
            ], 401);
        }
        $token = $user->createToken($request->name)->plainTextToken;
        return response()->json([
            'sukses' => true,
            'pesan' => 'Sukses',
            // 'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Berhasil Logout dan token terhapus'
        ], 201);
    }
}
