<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Запрос авторизации пользователя.
 */
final class AuthLoginRequest extends FormRequest
{
    /**
     * Правила валидации.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
