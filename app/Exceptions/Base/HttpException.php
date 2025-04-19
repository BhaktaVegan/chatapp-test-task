<?php

declare(strict_types=1);

namespace App\Exceptions\Base;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as BaseHttpException;
use Throwable;

/**
 * Base http-exception.
 */
class HttpException extends BaseHttpException
{
    /**
     * Текст сообщения.
     *
     * @var string
     */
    public $message = 'Error.';

    /**
     * Status code.
     *
     * @var string
     */
    public $code = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * Initialization.
     */
    public function __construct(
        string $message = null,
        Throwable $previous = null,
        int $code = null,
        array $headers = []
    ) {
        if (is_null($message)) {
            $message = $this->getMessage();
        }

        if (is_null($code)) {
            $code = $this->getCode();
        }

        parent::__construct($code, $message, $previous, $headers);
    }
}
