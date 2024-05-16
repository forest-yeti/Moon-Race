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

    #[ORM\Column(type: 'string', length: 32)]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $logo;

    #[ORM\Column(type: 'string')]
    private string $backgroundTheme;

    #[ORM\Column(type: 'string')]
    private string $audioBackground;

    #[ORM\Column(type: 'float')]
    private float $minBet;

    // TODO: Переименовать в betStepMax
    #[ORM\Column(type: 'integer')]
    private int $betStepCounter;

    #[ORM\ManyToOne(targetEntity: SlotJackpot::class)]
    private ?SlotJackpot $slotJackpot = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

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

    public function getAudioBackground(): string
    {
        return $this->audioBackground;
    }

    public function setAudioBackground(string $audioBackground): ISlotMachine
    {
        $this->audioBackground = $audioBackground;
        return $this;
    }

    public function getSlotJackpot(): ?SlotJackpot
    {
        return $this->slotJackpot;
    }

    public function setSlotJackpot(?SlotJackpot $slotJackpot): self
    {
        $this->slotJackpot = $slotJackpot;

        return $this;
    }
}
