<?php

namespace App\Services;

use App\DTOs\User\CreateUserDto;
use App\Entity\User;
use App\Infrastructure\Exceptions\UserException;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    public function register(CreateUserDto $dto)
    {
        $user = new User();
        $user->setEmail($dto->email);
        $user->setPassword($this->hashPassword($user, $dto->password));

        $this->userRepository->persist($user);

        return $user;
    }

    public function hashPassword(User $user, $plaintedPassword): string
    {
        return $this->passwordHasher->hashPassword(
            $user,
            $plaintedPassword
        );
    }
}
