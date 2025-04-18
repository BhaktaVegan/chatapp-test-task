<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use App\Modules\Auth\Exceptions\ErrorReceivingToken;
use App\Modules\Auth\Exceptions\InvalidCredentialsException;
use App\Modules\Auth\Services\AuthLoginService;
use App\Modules\User\Exceptions\UserNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Контроллер аутентификации.
 */
final class AuthController extends Controller
{
    /**
     * Аутентификация пользователя.
     *
     * @throws InvalidCredentialsException
     * @throws UserNotFoundException
     * @throws ErrorReceivingToken
     */
    public function login(
        AuthLoginRequest $request,
        AuthLoginService $service
    ): JsonResponse
    {
        $token = $service->run($request->validated());

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Выход из системы.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }
}

