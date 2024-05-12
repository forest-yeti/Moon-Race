<?php

namespace App\MoonRace\User\Contract;

interface IUserRegistrationData
{
    public function getName(): string;
    public function getEmail(): string;
    public function getPassword(): string;
}