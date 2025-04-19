<?php

declare(strict_types=1);

namespace App\Modules\Chat\Repositories;

use App\Enums\UserStatusEnum;
use App\Models\Chat;
use App\Models\User;
use App\Modules\User\Exceptions\UserNotFoundException;
use App\User\Enums\CustomerTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

/**
 * Репозиторий чата.
 */
final class ChatRepository
{
    /**
     * Поиск пользователя по почте.
     *
     * @throws UserNotFoundException
     */
    public function searchChatsBuilder(): Builder
    {
        return Chat::query()
            ->select('chats.*')
            ->join(
                'messages as m',
                'm.id',
                '=',
                'chats.last_message_id'
            )
            ->with(['creator', 'lastMessage'])
            ->orderByDesc('m.created_at');
    }
}
