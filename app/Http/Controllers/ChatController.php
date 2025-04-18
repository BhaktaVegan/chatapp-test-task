<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Chat\IndexChatRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Modules\Chat\Services\IndexChatService;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер чатов.
 */
final class ChatController extends Controller
{
    /**
     * Вывод списка всех чатов.
     */
    public function index(
        IndexChatRequest $request,
        IndexChatService $service
    ): JsonResponse {
        $chats = $service->run($request->toDto());

        return response()->json(ChatResource::collection($chats));
    }
}
