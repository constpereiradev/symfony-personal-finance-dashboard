<?php

namespace App\Controller;

use App\DTOs\User\CreateUserDto;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/user', name: 'app_user')]
final class UserController extends Controller
{
    public function __construct(private readonly UserService $userService) {}

    #[Route('', methods: ['GET'])]
    public function getLogged() 
    {
        /** @var User $user */
        $user = $this->userService->getLoggedUser();

        return $this->json([
            'message' => 'Success',
            'user' => $user->toArray()
        ]);
    }

    #[Route('', methods: ['POST'])]
    public function register(ValidatorInterface $validator, Request $request): JsonResponse
    {
        $data = $request->toArray();

        $dto = new CreateUserDto();
        $dto->email = $data['email'] ?? null;
        $dto->password = $data['password'] ?? null;

        $validationError = $this->validateRequest($validator, $dto);

        if ($validationError) {
            return $validationError;
        }

        $user = $this->userService->register($dto);

        return $this->json([
            'message' => 'User registered successfully',
            'user' => $user->toArray()
        ]);
    }
}
