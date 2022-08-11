<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

class AuthenticateController extends Controller
{
    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function register(Request $request)
    {
        $inputs = $request->validate([
            'first_name' => 'required | max: 40 | string',
            'last_name' => 'required | max: 40 | string',
            'email' => 'required | email | unique:users,email',
            'password' => 'required | string | confirmed',
        ]);

        $user = User::create([
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
            'email' => $inputs['email'],
            'password' => Hash::make($inputs['password'])
        ]);

        $token = $user->createToken('alex-api-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function login(Request $request)
    {
        $inputs = $request->validate([
            'email' => 'required | string | email',
            'password' => 'required'
        ]);

        $user = User::where('email', $inputs['email'])->first();

        if (!$user || !Hash::check($inputs['password'],$user->password)) {
            return response(['message' => 'Credentials do not match'], 401);
        }

        $token = $user->createToken('alex-api-token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);

    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function authorization(Request $request) {
        $inputs = $request->validate([
            'email' => 'required | string | email',
            'password' => 'required'
        ]);

        $user = User::where('email', $inputs['email'])->first();

        if (!$user || !Hash::check($inputs['password'],$user->password)) {
            return response(['message' => 'Credentials do not match'], 401);
        }

        $token = $user->createToken('alex-api-token')->plainTextToken;

        return response([
            'token' => $token
        ], 201);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return \response(['message' => 'Logged out'],201);
    }
}
