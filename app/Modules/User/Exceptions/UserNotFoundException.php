<?php

declare(strict_types=1);

namespace App\Modules\User\Exceptions;

use App\Exceptions\Base\HttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение, пользователь не найден.
 */
final class UserNotFoundException extends HttpException
{
    /**
     * Message text.
     *
     * @var string
     */
    public $message = 'Пользователь не найден.';

    /**
     * Status code.
     *
     * @var string
     */
    public $code = Response::HTTP_NOT_FOUND;
}
