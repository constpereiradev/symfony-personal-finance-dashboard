<?php

namespace App\DTOs\User;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDto
{
    #[Assert\NotBlank]
    public ?string $email = null;

    #[Assert\NotBlank]
    public ?string $password = null;
}
