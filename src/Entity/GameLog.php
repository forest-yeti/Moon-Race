<?php

namespace App\Entity;

use App\MoonRace\GameLog\Entity\IGameLog;
use App\Repository\GameLogRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameLogRepository::class)]
class GameLog implements IGameLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private string $gameType;

    #[ORM\Column(type: 'integer')]
    private int $gameId;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private User $user;

    #[ORM\Column(type: 'float')]
    private float $randomNumber;

    #[ORM\Column(type: 'boolean')]
    private bool $win;

    #[ORM\Column(type: 'array')]
    private array $metaData = [];

    #[ORM\Column(type: 'datetime')]
    private DateTime $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function setGameId(int $gameId): IGameLog
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

    public function setUser(User $user): IGameLog
    {
        $this->user = $user;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

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
