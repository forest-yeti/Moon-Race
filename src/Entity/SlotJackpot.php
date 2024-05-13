<?php

namespace App\Entity;

use App\MoonRace\Slot\Entity\ISlotJackpot;
use App\Repository\SlotJackpotRepository;
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

    #[ORM\Column(type: 'float')]
    private float $winRate;

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

    public function getWinRate(): float
    {
        return $this->winRate;
    }

    public function setWinRate(float $winRate): self
    {
        $this->winRate = $winRate;

        return $this;
    }
}
