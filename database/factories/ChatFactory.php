<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * фабрика для чатов.
 */
class ChatFactory extends Factory
{
    /**
     * Модель.
     *
     * @var string
     */
    protected $model = Chat::class;

    /**
     * Определение.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'creator_id' => User::factory(),
        ];
    }
}
