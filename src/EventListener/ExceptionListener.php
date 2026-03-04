<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onkernelException(ExceptionEvent $event): void
    {

        $exception = $event->getThrowable();

        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        if($exception instanceof HttpExceptionInterface){
            $statusCode = $exception->getStatusCode();
        }

        $response = new JsonResponse([
            'error' => $exception->getMessage()
        ], $statusCode);

        $event->setResponse($response);
    }
}