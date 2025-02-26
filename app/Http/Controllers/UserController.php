<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Регистрация пользователя
    public function registration(RegisterRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::query()->create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'birth_date' => $request->get('birth_date'),
            'password' => Hash::make($request->get('password')),
        ]);

        return $this->returnResponseJson($user, 201);
    }

    // Авторизация пользователя
    public function login(LoginRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::query()->where('email', $request->get('email'))->first();

        if ($user && Hash::check($request->get('password'), $user->password)) {
            return $this->returnResponseJson($user);
        }

        return response()->json([], 404);
    }

    // Получение пользователя
    public function getUser(Request $request): JsonResponse
    {
        return response()->json(new UserResource($request->user()));
    }

    // Выход пользователя
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(null, 204);
    }

    // JSON ответ
    private function returnResponseJson(User $user, int $status = 200): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('auth')->plainTextToken,
        ], $status);
    }
}
