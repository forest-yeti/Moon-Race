<?php

namespace App\MoonRace\Security\Entity;

interface IUserSecurity
{
    public function getPassword(): string;
    public function setPassword(string $password);
}