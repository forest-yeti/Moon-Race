<?php

namespace App\MoonRace\GameLog\Entity;

use App\Entity\User;
use DateTime;

interface IGameLog
{
    public function getGameType(): string;
    public function setGameType(string $gameType): self;

    public function getGameId(): int;
    public function setGameId(int $gameId): self;

    public function getMetaData(): array;
    public function setMetaData(array $metaData): self;

    public function getUser(): User;
    public function setUser(User $user): self;

    public function getCreatedAt(): DateTime;
    public function setCreatedAt(DateTime $createdAt): self;

    public function getRandomNumber(): float;
    public function setRandomNumber(float $randomNumber): self;

    public function isWin(): bool;
    public function setWin(bool $win): self;
}