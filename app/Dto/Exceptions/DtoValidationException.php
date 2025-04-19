<?php

declare(strict_types=1);

namespace App\Dto\Exceptions;

use App\Exceptions\Base\HttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * DTO validation exception.
 */
final class DtoValidationException extends HttpException
{
    /**
     * Error message.
     *
     * @var string
     */
    public $message = 'DTO validation failed.';

    /**
     * Status code.
     *
     * @var string
     */
    public $code = Response::HTTP_UNPROCESSABLE_ENTITY;
}
