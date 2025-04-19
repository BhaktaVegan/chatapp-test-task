<?php

declare(strict_types=1);

namespace App\Modules\Chat\Dtos;

/**
 * DTO поиска чатов.
 */
final class SearchChatDto extends ChatDto
{
    /**
     * Правила валидации.
     */
    public function rules(): array
    {
        return parent::rules();
    }
}
