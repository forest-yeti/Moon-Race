<?php

namespace App\Entity;

use App\MoonRace\Slot\Entity\ISlotJackpot;
use App\Repository\SlotJackpotRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SlotJackpotRepository::class)]
class SlotJackpot implements ISlotJackpot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'float')]
    private float $jackpot;

    // Лузовость игрока - минимальный процент проигрышей, для того, чтобы пользователь мог участвовать в джекпоте
    // Имеет значения от 0 до 1
    #[ORM\Column(type: 'float')]
    private float $playerLooseness;

    // Минимальное количество игр в которые должен проиграть пользователь, для того, чтобы претендовать на джекпот
    #[ORM\Column(type: 'integer')]
    private int $minPlayerGames;

    // Дата, после который происходит розыгрыш джекпота
    #[ORM\Column(type: 'datetime')]
    private DateTime $drawDateFrom;

    #[ORM\Column(type: 'float')]
    private float $winRate;

    // Процент, сколько денег отчисляется в джекпот, в случае поражения игрока в одном прокруте
    // Имеет значения от 0 до 1
    #[ORM\Column(type: 'float')]
    private float $loseAccumulationPercent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJackpot(): float
    {
        return $this->jackpot;
    }

    public function setJackpot(float $jackpot): self
    {
        $this->jackpot = $jackpot;

        return $this;
    }

    public function getPlayerLooseness(): float
    {
        return $this->playerLooseness;
    }

    public function setPlayerLooseness(float $playerLooseness): self
    {
        $this->playerLooseness = $playerLooseness;

        return $this;
    }

    public function getDrawDateFrom(): DateTime
    {
        return $this->drawDateFrom;
    }

    public function setDrawDateFrom(DateTime $drawDateFrom): self
    {
        $this->drawDateFrom = $drawDateFrom;

        return $this;
    }

    public function getMinPlayerGames(): int
    {
        return $this->minPlayerGames;
    }

    public function setMinPlayerGames(int $minPlayerGames): self
    {
        $this->minPlayerGames = $minPlayerGames;

        return $this;
    }

    public function getWinRate(): float
    {
        return $this->winRate;
    }

    public function setWinRate(float $winRate): self
    {
        $this->winRate = $winRate;

        return $this;
    }

    public function getLoseAccumulationPercent(): float
    {
        return $this->loseAccumulationPercent;
    }

    public function setLoseAccumulationPercent(float $loseAccumulationPercent): self
    {
        $this->loseAccumulationPercent = $loseAccumulationPercent;

        return $this;
    }
}
