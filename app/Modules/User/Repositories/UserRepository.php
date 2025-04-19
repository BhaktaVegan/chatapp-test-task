<?php

declare(strict_types=1);

namespace App\Modules\User\Repositories;

use App\Enums\UserStatusEnum;
use App\Models\User;
use App\Modules\User\Exceptions\UserNotFoundException;
use App\User\Enums\CustomerTypeEnum;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

/**
 * Репозиторий пользователя.
 */
final class UserRepository
{
    /**
     * Поиск пользователя по почте.
     *
     * @throws UserNotFoundException
     */
    public function findByEmail(string $email): User
    {
        /** @var User $user */
        $user = User::query()
            ->where('email', $email)
            ->first();

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
