<?php

namespace App\MoonRace\Security\Service;

use App\MoonRace\Security\Entity\IUserSecurity;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPasswordSecurity
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher
    ) {}

    public function updatePassword(string $targetPassword, IUserSecurity $updatableUser): void
    {
        $hashedPassword = $this->userPasswordHasher->hashPassword($updatableUser, $targetPassword);
        $updatableUser->setPassword($hashedPassword);
    }
}