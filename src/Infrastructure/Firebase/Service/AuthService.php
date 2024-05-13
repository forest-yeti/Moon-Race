<?php

namespace App\Infrastructure\Firebase\Service;

use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\Security\Service\IAuthService;
use App\MoonRace\Security\ValueObject\UserAuthToken;
use App\MoonRace\User\Entity\IUser;
use App\MoonRace\User\Repository\IUserRepository;
use DateTime;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\Request;

class AuthService implements IAuthService
{
    public function __construct(
        private readonly string          $secretKey,
        private readonly int             $tokenTtl,
        private readonly string          $issuer,
        private readonly IUserRepository $userRepository,
        private readonly string          $algorithm = 'HS256'
    ) {}

    public function login(IUser $user): UserAuthToken
    {
        $now         = new DateTime();
        $expiredTime = $now->modify(
            sprintf('+%d seconds', $this->tokenTtl)
        );

        $payload = [
            'iss' => $this->issuer,
            'exp' => $expiredTime->getTimestamp(),
            'user' => [
                'id' => $user->getId(),
            ]
        ];

        $token = JWT::encode(
            $payload,
            $this->secretKey,
            $this->algorithm
        );

        return new UserAuthToken($token, $expiredTime);
    }

    /**
     * @throws RuntimeException
     */
    public function getUser(): IUser
    {
        $jwtToken = $this->getCurrentToken();

        try {
            $decoded = JWT::decode(
                $jwtToken,
                new Key(
                    $this->secretKey,
                    $this->algorithm
                )
            );
        } catch (ExpiredException) {
            throw new RuntimeException('The token was expired');
        }

        $userId = $decoded->user->id;
        return $this->userRepository->findById($userId);
    }

    /**
     * @throws RuntimeException
     */
    private function getCurrentToken(): string
    {
        $request = Request::createFromGlobals();

        $jwtToken = $request->headers->get('Authorization');
        if ($jwtToken === null) {
            throw new RuntimeException('Authorization failed, JWT Token not exist');
        }

        return $jwtToken;
    }
}