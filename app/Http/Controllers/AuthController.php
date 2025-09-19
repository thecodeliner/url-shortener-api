<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $validate = $request->validate([

            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users',
            'password' => 'required|min:6',

        ]);



        $user = User::create([

            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),

        ]);

        return response()->json(['message' => 'User Created successfully', 'status'=>true]);
    }

    public function login(Request $request){

        $validate = $request->validate([


            'email'=> 'required|email',
            'password' => 'required|min:6',

        ]);
        //check email exists in database
        $user = User::where('email', $validate['email'])->first();
        if(!$user || !Hash::check($validate['password'], $user->password)){

            return response()->json([
                'message' => 'invalid credentials',
                'statur' => false
            ], 401);

        }
        $token = $user->createToken('api')->plainTextToken;
        return response()->json([
            'message' => 'User Logged in successfully',
            'status'=>true,
            'token' => $token
        ]);

    }

    public function logout(Request $request)
{
    $user = $request->user();

    if ($user) {
        $user->tokens()->delete();

        return response()->json([
            'message' => 'User logged out from all devices',
            'status'  => true
        ]);
    }

    return response()->json([
        'message' => 'No active session or token found',
        'status'  => false
    ], 401);
}


}
