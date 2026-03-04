<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class Controller extends AbstractController
{
    public function validateRequest(ValidatorInterface $validator, $dto)
    {
        $errors = $validator->validate($dto);

        if (count($errors) > 0) {

            return $this->json([
                'message' => 'An error occurred',
                'errors' => $this->formatErrors($errors)
            ], Response::HTTP_UNPROCESSABLE_ENTITY );
        }
    }

    public function formatErrors($errors): array
    {
        $formatted = [];

        foreach ($errors as $error) {
            $field = $error->getPropertyPath();
            $message = $error->getMessage();

            $formatted[] = [
                'field' => $field,
                'message' => $message
            ];
        }

        return $formatted;
    }
}
