<?php

namespace App\MoonRace\User\Entity;

interface IUserGameEntityBuilder
{
    public function build(): IUserGame;
}