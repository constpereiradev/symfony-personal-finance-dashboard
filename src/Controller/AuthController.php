<?php

namespace App\Controller;

use App\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth')]
final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    #[Route('/login', methods: ['POST'], name: 'app_auth_login')]
    public function authenticate() {}

}
