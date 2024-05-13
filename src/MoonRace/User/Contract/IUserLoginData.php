<?php

namespace App\MoonRace\User\Contract;

interface IUserLoginData
{
    public function getEmail(): string;
    public function getPassword(): string;
}