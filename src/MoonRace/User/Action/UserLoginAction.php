<?php

namespace App\MoonRace\User\Action;

use App\MoonRace\Security\Service\IAuthService;
use App\MoonRace\Security\Service\UserPasswordSecurity;
use App\MoonRace\Security\ValueObject\UserAuthToken;
use App\MoonRace\User\Contract\IUserLoginData;
use App\MoonRace\User\Repository\IUserRepository;
use App\MoonRace\Common\Exception\RuntimeException;

class UserLoginAction
{
    public function __construct(
        private readonly IUserRepository      $userRepository,
        private readonly UserPasswordSecurity $userPasswordSecurity,
        private readonly IAuthService         $authService
    ) {}

    /**
     * @throws RuntimeException
     */
    public function run(IUserLoginData $data): UserAuthToken
    {
        $user = $this->userRepository->findByEmail($data->getEmail());
        if ($user === null) {
            throw new RuntimeException('Ops... Wrong email or password');
        }

        if (!$this->userPasswordSecurity->verifyPassword($data->getPassword(), $user)) {
            throw new RuntimeException('Ops... Wrong email or password');
        }

        return $this->authService->login($user);
    }
}