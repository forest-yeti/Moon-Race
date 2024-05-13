<?php

namespace App\MoonRace\User\Repository;

use App\MoonRace\User\Entity\IUser;

interface IUserRepository
{
    public function findById(int $id): ?IUser;

    public function findByEmail(string $email): ?IUser;

    public function findBySocketToken(string $socketToken): ?IUser;
}