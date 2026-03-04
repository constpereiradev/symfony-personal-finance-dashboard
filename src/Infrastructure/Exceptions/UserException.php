<?php

namespace App\Infrastructure\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserException extends HttpException
{
    public static function failedToRegister($message = 'Failed to register', $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return new self($code, $message);
    }
}