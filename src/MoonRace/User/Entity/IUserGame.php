<?php

namespace App\MoonRace\User\Entity;

use App\Entity\User;

interface IUserGame
{
    public function getUser(): User;
    public function setUser(User $user): self;

    public function getType(): string;
    public function setType(string $type): self;

    public function getGameId(): int;
    public function setGameId(int $gameId): self;
}