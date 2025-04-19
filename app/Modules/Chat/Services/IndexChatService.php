<?php

declare(strict_types=1);

namespace App\Modules\Chat\Services;

use App\Modules\Chat\Dtos\SearchChatDto;
use App\Modules\Chat\Repositories\ChatRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Сервис получения коллекции чатов.
 */
final class IndexChatService
{
    /**
     * Initialization.
     */
    public function __construct(
        private ChatRepository $chatRepository,
    ) {
    }

    /**
     * Запуск сервиса.
     */
    public function run(SearchChatDto $dto): LengthAwarePaginator
    {
        $data = $dto->toArray();

        return $this->chatRepository
            ->searchChatsBuilder()
            ->paginate($data['items_per_page'], ['*'], 'page', $data['page']);
    }
}
