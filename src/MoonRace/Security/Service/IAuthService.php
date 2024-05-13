<?php

namespace App\MoonRace\Security\Service;

use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\Security\ValueObject\UserAuthToken;
use App\MoonRace\User\Entity\IUser;

interface IAuthService
{
    public function login(IUser $user): UserAuthToken;

    /**
     * @throws RuntimeException
     */
    public function getUser(): IUser;
}