<?php

declare(strict_types=1);

namespace App\Http\Requests\Chat;

use App\Modules\Chat\Dtos\SearchChatDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Запрос для получения чатов.
 */
final class IndexChatRequest extends FormRequest
{

    /**
     * Подготовка запроса к валидации.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'items_per_page' => $this->query('itemsPerPage'),
            'page' => $this->query('page'),
        ]);
    }

    /**
     * Правила валидации.
     */
    public function rules(): array
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
            'items_per_page' => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Представление запроса в виде DTO.
     */
    public function toDto(): SearchChatDto
    {
        return app()->make(SearchChatDto::class, ['data' =>
            [
                'page' => (int) $this->input('page'),
                'items_per_page' => (int) $this->input('items_per_page'),
            ]
        ]);
    }
}
