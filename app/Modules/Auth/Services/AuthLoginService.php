<?php

declare(strict_types=1);

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Exceptions\ErrorReceivingToken;
use App\Modules\Auth\Exceptions\InvalidCredentialsException;
use App\Modules\User\Exceptions\UserNotFoundException;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Модель сообщения часа.
 */
final class AuthLoginService
{
    /**
     * Initialization.
     */
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    /**
     * Run service.
     *
     * @throws InvalidCredentialsException
     * @throws UserNotFoundException
     * @throws ErrorReceivingToken
     */
    public function run(array $validatedData): ?string
    {
        $user = $this->userRepository->findByEmail($validatedData['email']);

        if (!Hash::check($validatedData['password'], $user->password)) {
            throw new InvalidCredentialsException();
        }

        $token = $user?->createToken('auth_token')?->plainTextToken;

        if (!$token) {
            throw new ErrorReceivingToken();
        }

        return $token;
    }
}
