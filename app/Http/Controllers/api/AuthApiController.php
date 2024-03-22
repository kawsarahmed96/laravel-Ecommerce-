<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{

    // signup user

    public function signup(Request $request)
    {

        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->name),
        ]);

        $user->assignRole('user');

        $token = $user->createToken('mobile')->plainTextToken;

        $respons = [
            'error'   => true,
            'message' => 'User not Created',
        ];

        if (!$user) {
            return response()->json($respons, 400);
        }

        $respons = [
            'error'   => false,
            'message' => 'User Created successful',
            'token'   => $token,
            'user'    => new UserResource(User::findOrFail($user->id)),

        ];

        return response()->json($respons, 201);

    }

    // login user

    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|email',
            'password'    => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken("$request->device_name")->plainTextToken;

        if ($token) {
            $response = [
                "error"   => false,
                "token"   => $token,
                "message" => "Login successful",
            ];
            return response()->json($response, 200);

        } else {
            $response = [
                "error"   => true,

                "message" => "Login not successful",
            ];
            return response()->json($response, 404);
        }

    }

    // logout user

    public function logout(Request $request, $id)
    {

        $user = User::findOrFail($request->id);
        $user->tokens()->delete();

        $respons = [
            'error'   => false,
            'message' => 'User logout successfull',

        ];

        return response()->json($respons, 201);

    }
}
