<?php

declare(strict_types=1);

namespace Tests\App\Http\Controllers;

use App\Http\Controllers\ChatController;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Tests for ChatController.
 *
 * @group Global
 * @group ChatController
 * @coversDefaultClass ChatController
 */
final class ChatControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /**
     * Тест успешного получения списка чатов.
     *
     * @covers ChatController::index
     * @throws Exception
     */
    public function testIndexSuccess(): void
    {
        $users = User::factory()->count(10)->create();
        $this->actingAs(User::factory()->create());
        /** @var Chat $chats */
        $chats = Chat::factory()
            ->count(5)
            ->create();
        foreach ($chats as $chat) {
            /** @var Message $messages */
            $messages = Message::factory()
                ->count(100)
                ->create([
                    'chat_id' => $chat->id,
                    'sender_id' => User::factory()->create()->id,
                    'recipient_id' => User::factory()->create()->id,
                ])
                ->each(function (Message $message) use ($users) {
                    $sender = $users->random();
                    $recipient = $users->where('id', '!=', $sender->id)
                        ->random();

                    $message->update([
                        'sender_id' => $sender->id,
                        'recipient_id' => $recipient->id,
                    ]);
                });

            $messages = collect($messages)->sortByDesc('created_at');
            $chat->last_message_id = $messages->first()->id;
        }

        $response = $this->getJson(route('chats.index', [
            'page' => 1,
            'itemsPerPage' => 20,
        ]));

        $response->assertOk()
            ->assertJsonCount(20)
            ->assertJsonStructure([
                [
                    'id',
                    'title',
                    'last_message_text',
                    'last_message_created_at',
                    'creator' => [
                        'id',
                        'name',
                        'email',
                    ],
                ]
            ]);
    }
}
