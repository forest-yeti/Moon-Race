<?php

namespace App\Infrastructure\Doctrine\EntityBuilder;

use App\Entity\User;
use App\MoonRace\User\Entity\IUser;
use App\MoonRace\User\Entity\IUserEntityBuilder;

class UserEntityBuilder implements IUserEntityBuilder
{
    public function build(): IUser
    {
        return new User();
    }
}