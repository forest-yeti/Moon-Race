<?php

namespace App\MoonRace\User\Repository;

use App\MoonRace\User\Entity\IUser;
use App\MoonRace\User\Entity\IUserGame;

interface IUserGameRepository
{
    public function findByUser(IUser $user): ?IUserGame;
}