<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function __invoke(AuthenticateRequest $request): JsonResponse
    {
        if (!auth()->attempt($request->only(['phone', 'password']))) {
            return json([
                'message' => 'Неверный логин или пароль'
            ], 401);
        }

        $user = User::query()->where('phone', $request->phone)->first();
        $token = $user->createToken('token')->plainTextToken;

        return json([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
