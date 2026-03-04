<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class Controller extends AbstractController
{
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
