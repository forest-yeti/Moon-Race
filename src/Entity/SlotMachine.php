<?php

namespace App\Entity;

use App\MoonRace\Slot\Entity\ISlotMachine;
use App\Repository\SlotMachineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SlotMachineRepository::class)]
class SlotMachine implements ISlotMachine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private string $backgroundTheme;

    #[ORM\Column(type: 'float')]
    private float $minBet;

    #[ORM\Column(type: 'integer')]
    private int $betStepCounter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBackgroundTheme(): string
    {
        return $this->backgroundTheme;
    }

    public function setBackgroundTheme(string $backgroundTheme): ISlotMachine
    {
        $this->backgroundTheme = $backgroundTheme;
        return $this;
    }

    public function getMinBet(): float
    {
        return $this->minBet;
    }

    public function setMinBet(float $minBet): self
    {
        $this->minBet = $minBet;
        return $this;
    }

    public function getBetStepCounter(): int
    {
        return $this->betStepCounter;
    }

    public function setBetStepCounter(int $betStepCounter): self
    {
        $this->betStepCounter = $betStepCounter;
        return $this;
    }
}
