<?php

namespace App\Infrastructure\Doctrine\EntityBuilder;

use App\Entity\UserGame;
use App\MoonRace\User\Entity\IUserGame;
use App\MoonRace\User\Entity\IUserGameEntityBuilder;

class UserGameEntityBuilder implements IUserGameEntityBuilder
{
    public function build(): IUserGame
    {
        return new UserGame();
    }
}