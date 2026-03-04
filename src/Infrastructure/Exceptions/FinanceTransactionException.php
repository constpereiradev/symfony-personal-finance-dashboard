<?php

namespace App\Infrastructure\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FinanceTransactionException extends HttpException 
{
    public static function financeTransactionNotFound(?string $message = 'Finance transaction not found'): self
    {
        return new self(Response::HTTP_NOT_FOUND, $message);
    }
}
