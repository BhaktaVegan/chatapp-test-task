<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель соощения чата.
 *
 * @param int $id
 * @param int $chat_id
 * @param int $sender_id
 * @param int $recipient_id
 * @param string $message
 */
final class Message extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     * Название таблицы.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * Поля для массового заполнения.
     *
     * @var array
     */
    protected $fillable = [
        'chat_id',
        'sender_id',
        'recipient_id',
        'message',
    ];

    /**
     * Чат сообщения.
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'chat_id', 'id');
    }

    /**
     * Отправитель.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    /**
     * Полчучатель.
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }
}
