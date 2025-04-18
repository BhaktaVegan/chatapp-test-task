<?php

declare(strict_types=1);

namespace App\Modules\Chat\Dtos;

use App\Dto\Dto;

/**
 * DTO чата.
 */
class ChatDto extends Dto
{
    /**
     * Количество записей на странице.
     */
    protected int $itemsPerPage;

    /**
     * Страница.
     */
    protected int $page;

    /**
     * Правила валидации.
     */
    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'items_per_page' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
