<?php

namespace App\MoonRace\User\Entity;

interface IUser
{
    public function getName(): string;
    public function setName(string $name): self;

    public function getEmail(): string;
    public function setEmail(string $email): self;

    public function getAvatar(): string;
    public function setAvatar(string $avatar): self;
}