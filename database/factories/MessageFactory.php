<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * фабрика для сообщений чатов.
 */
final class MessageFactory extends Factory
{
    /**
     * Модель.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Определение.
     */
    public function definition(): array
    {
        return [
            'chat_id' => Chat::factory(),
            'sender_id' => User::factory(),
            'recipient_id' => User::factory(),
            'message' => $this->faker->sentence(rand(20, 300)),
        ];
    }
}
