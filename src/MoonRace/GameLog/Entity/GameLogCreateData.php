<?php

namespace App\MoonRace\GameLog\Entity;

use App\Entity\User;
use DateTime;

class GameLogCreateData
{
    private string   $gameType;
    private int      $gameId;
    private array    $metaData = [];
    private User     $user;
    private float    $randomNumber;
    private bool     $win;

    public function getGameType(): string
    {
        return $this->gameType;
    }

    public function setGameType(string $gameType): self
    {
        $this->gameType = $gameType;

        return $this;
    }

    public function getGameId(): int
    {
        return $this->gameId;
    }

    public function setGameId(int $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
    }

    public function getMetaData(): array
    {
        return $this->metaData;
    }

    public function setMetaData(array $metaData): self
    {
        $this->metaData = $metaData;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRandomNumber(): float
    {
        return $this->randomNumber;
    }

    public function setRandomNumber(float $randomNumber): self
    {
        $this->randomNumber = $randomNumber;

        return $this;
    }

    public function isWin(): bool
    {
        return $this->win;
    }

    public function setWin(bool $win): self
    {
        $this->win = $win;

        return $this;
    }
}