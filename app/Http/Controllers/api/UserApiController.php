<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{

    /** single user show */

    public function show($id)
    {
        $user = User::findOrFail($id);

        $user = new UserResource($user);

        $respons = [
            'error'   => false,
            'message' => 'User view successful',
            'user'    => $user,
        ];

        return response()->json($respons, 200);

    }

    //All user list

    public function userList()
    {
        $users = User::all();
        $users = UserResource::collection($users);

        $respons = [
            'error' => false,
            'users' => $users,
        ];
        return response()->json($respons, 200);
    }

    //single user update

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',

        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,

        ]);

        $respons = [
            'error'   => false,
            'message' => 'User updated successful',
            'user'    => new UserResource($user),

        ];

        return response()->json($respons, 201);

    }

    //single user delete

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ], [
            'id.required' => 'User id not found',
        ]);

        $user = User::findOrFail($request->id);

        $user->delete();

        $respons = [
            'error'   => false,
            'message' => 'User deleted successful',

        ];

        return response()->json($respons, 200);

    }
}
