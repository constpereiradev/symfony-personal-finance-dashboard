<?php

namespace App\Controller;

use App\Repository\RefreshTokenRepository;
use App\Services\AuthService;
use DateTime;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/api/auth')]
final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService,
        private readonly RefreshTokenRepository $refreshTokenRepository
    ) {}

    #[Route('/login', methods: ['POST'], name: 'app_auth_login')]
    public function authenticate(#[CurrentUser] $user): JsonResponse
    {

        $jwt = $this->authService->generateJWTToken($user);

        $accessTokenCookie = $this->authService->generateCookie($user, $jwt, 'access_token', (new \DateTime('+15 minutes')));
        $refreshToken = $this->authService->registerRefreshToken($user);
        $refreshTokenCookie = $this->authService->generateCookie($user, $refreshToken->getToken(), 'refresh_token', $refreshToken->getExpiresAt());


        $response = $this->json([
            'message' => 'Login realized successfully',
        ]);

        $response->headers->setCookie($accessTokenCookie);
        $response->headers->setCookie($refreshTokenCookie);

        return $response;
    }

    #[Route('/refresh', methods: ['POST'], name: 'app_auth_refresh')]
    public function refreshToken(Request $request): JsonResponse
    {
        $refreshToken = $request->cookies->get('refresh_token');

        $token = $this->refreshTokenRepository->findOneBy([
            'token' => $refreshToken
        ]);

        if (!$token) {
            if (!$token) {
                return $this->json(['error' => 'Invalid refresh token'], Response::HTTP_NOT_FOUND);
            }
        }

        if ($token->getExpiresAt() < new \DateTime()) {
            return $this->json(['error' => 'Refresh token expired'], Response::HTTP_NOT_FOUND);
        }

        $user = $token->getUser();

        $userTokens = $this->refreshTokenRepository->findAllByUser($user);

        foreach ($userTokens as $userToken) {
            $this->refreshTokenRepository->delete($userToken);
        }


        $jwt = $this->authService->generateJWTToken($user);
        $accessToken = $this->authService->generateCookie($user, $jwt, 'access_token', (new \DateTime('+15 minutes')));

        $response = $this->json([
            'message' => 'Token refreshed successfully',
        ]);

        $response->headers->setCookie($accessToken);
        return $response;
    }

    #[Route('/logout', methods: ['POST'], name: 'app_auth_logout')]
    public function logout(Request $request): JsonResponse
    {
        $refreshToken = $request->cookies->get('refresh_token');

        if ($refreshToken) {
            $userTokens = $this->refreshTokenRepository->findAllByUser($this->authService->getLoggedUser());

            foreach ($userTokens as $userToken) {
                $this->refreshTokenRepository->delete($userToken);
            }
        }

        $response = $this->json([
            'message' => 'Logout successful'
        ]);

        $response->headers->clearCookie('access_token');
        $response->headers->clearCookie('refresh_token');

        return $response;
    }
}
