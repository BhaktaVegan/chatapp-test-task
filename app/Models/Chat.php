<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель чата.
 *
 * @param int $id
 * @param string $title
 * @param int $creator_id
 */
class Chat extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     * Название таблицы.
     *
     * @var string
     */
    protected $table = 'chats';

    /**
     * Поля для массового заполнения.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'creator_id',
    ];

    /**
     * Создатель чата.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Сообщения чата.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(User::class, 'chat_id', 'id');
    }

    /**
     * Последнее сообщение в чате.
     */
    public function lastMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }
}
