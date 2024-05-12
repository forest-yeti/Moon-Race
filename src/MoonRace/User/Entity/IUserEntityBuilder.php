<?php

namespace App\MoonRace\User\Entity;

interface IUserEntityBuilder
{
    public function build(): IUser;
}