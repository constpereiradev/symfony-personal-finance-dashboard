<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class Controller extends AbstractController
{
    public function formatErrors(ConstraintViolationListInterface $errors): array
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
