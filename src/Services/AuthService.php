<?php

namespace App\Services;

use Symfony\Bundle\SecurityBundle\Security;

class AuthService
{
    public function __construct(
        private readonly Security $security
    ) {}

    public function getLoggedUser()
    {
        return $this->security->getUser();
    }
}
