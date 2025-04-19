<?php

declare(strict_types=1);

namespace App\Modules\Auth\Exceptions;

use App\Exceptions\Base\HttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение при неверных кредых при авторизации.
 */
final class InvalidCredentialsException extends HttpException
{
    /**
     * Message text.
     *
     * @var string
     */
    public $message = 'Неверные логин или пароль.';

    /**
     * Status code.
     *
     * @var string
     */
    public $code = Response::HTTP_UNAUTHORIZED;
}
