<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * Сидер таблицы чатов.
 */
final class ChatSeeder extends Seeder
{
    /**
     * Запуск сидера.
     */
    public function run(): void
    {
        $userIds = User::query()
            ->pluck('id')
            ->toArray();

        Chat::factory()->count(100)->create()->each(function (Chat $chat) use ($userIds) {
            $messageCount = rand(10, 100);
            $messages = collect();

            for ($i = 0; $i < $messageCount; $i++) {
                $sender = collect($userIds)->random();
                $recipient = collect($userIds)->reject(fn ($id) => $id === $sender)
                    ->random();

                $messages->push(Message::factory()->create([
                    'chat_id' => $chat->id,
                    'sender_id' => $sender,
                    'recipient_id' => $recipient,
                    'message' => Str::random(rand(20, 300)),
                    'created_at' => now()->subDays(rand(0, 30))
                        ->addMinutes(rand(0, 1440)),
                ]));
            }

            $lastMessage = $messages->sortByDesc('created_at')
                ->first();
            $chat->update(['last_message_id' => $lastMessage->id]);
        });
    }
}
