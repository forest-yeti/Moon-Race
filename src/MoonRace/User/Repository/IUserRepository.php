<?php

namespace App\MoonRace\User\Repository;

use App\Entity\User;

interface IUserRepository
{
    public function findByEmail(string $email): ?User;
}