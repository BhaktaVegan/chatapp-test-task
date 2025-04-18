<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Контроллер чатов.
 */
final class ChatController extends Controller
{
    public function index(IndexChatSergvice $service): JsonResponse
    {
        $chats = $service->run();
    }
}
