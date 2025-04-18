<?php

declare(strict_types=1);

namespace App\Http\Resources\Chat;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * Ресурс чата.
 */
final class ChatResource extends JsonResource
{
    /**
     * Лимит символов для последнего сообщения чата.
     *
     * @var int
     */
    private const MESSAGE_CHARS_LIMIT = 100;

    /**
     * Представление ресурса в виде массива.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'last_message_text' => Str::limit($this->lastMessage, self::MESSAGE_CHARS_LIMIT),
            'last_message_created_at' => $this->lastMessage->created_at,
            'creator' => UserResource::make($this->creator),
        ];
    }
}
