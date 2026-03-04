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

    #[Route('', methods: ['POST'])]
    public function register(ValidatorInterface $validator, Request $request): JsonResponse
    {
        $data = $request->toArray();

        $dto = new CreateUserDto();
        $dto->email = $data['email'] ?? null;
        $dto->password = $data['password'] ?? null;

        $errors = $validator->validate($dto);

        if (count($errors) > 0) {
            return $this->json([
                'message' => 'An error occured',
                'errors' => $this->formatErrors($errors),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $user = $this->userService->register($dto);

        return $this->json([
            'message' => 'User registered successfully',
            'user' => $user->toArray()
        ]);
    }
}
