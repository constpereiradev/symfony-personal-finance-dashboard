<?php

namespace App\Services;

use App\Entity\RefreshToken;
use App\Entity\User;
use App\Repository\RefreshTokenRepository;
use DateTime;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Cookie;

class AuthService
{
    public function __construct(
        private readonly Security $security,
        private readonly JWTTokenManagerInterface $jwtManager,
        private readonly RefreshTokenRepository $refreshTokenRepository

    ) {}

    public function getLoggedUser()
    {
        return $this->security->getUser();
    }

    public function generateJWTToken(User $user): string
    {
        return $this->jwtManager->create($user);
    }

    public function generateCookie(User $user, string $jwt, string $name, DateTime $expiration): Cookie
    {
        return Cookie::create(
            $name,
            $jwt,
            $expiration,
            '/',
            null,
            true,
            true,
            false,
            Cookie::SAMESITE_STRICT
        );
    }

    public function generateRefreshToken()
    {
        return bin2hex(random_bytes(64));
    }

    public function registerRefreshToken(User $user): RefreshToken
    {
        $token = $this->generateRefreshToken();

        $refreshToken = $this->refreshTokenRepository->store([
            'user' => $user,
            'token' => $token,
            'expires_at' => new \DateTime('+7 days')
        ]);

        return $refreshToken;
    }
}
