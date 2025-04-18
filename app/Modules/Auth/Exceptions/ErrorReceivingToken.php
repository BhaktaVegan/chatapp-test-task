<?php

declare(strict_types=1);

namespace App\Modules\Auth\Exceptions;

use App\Exceptions\Base\HttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение при неверных кредых при авторизации.
 */
final class ErrorReceivingToken extends HttpException
{
    /**
     * Message text.
     *
     * @var string
     */
    public $message = 'Ошибка получения токена.';

    /**
     * Status code.
     *
     * @var string
     */
    public $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}
