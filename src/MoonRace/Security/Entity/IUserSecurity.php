<?php

namespace App\MoonRace\Security\Entity;

interface IUserSecurity
{
    public function getPassword(): string;
    public function setPassword(string $password);

    public function getSocketToken(): string;
    public function setSocketToken(string $socketToken): self;
}