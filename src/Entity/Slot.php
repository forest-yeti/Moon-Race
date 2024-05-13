<?php

namespace App\Entity;

use App\MoonRace\Slot\Entity\ISlot;
use App\MoonRace\Slot\Entity\ISlotMachine;
use App\Repository\SlotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SlotRepository::class)]
class Slot implements ISlot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: SlotMachine::class)]
    private SlotMachine $slotMachine;

    #[ORM\Column(type: 'float')]
    private float $prizeInLine;

    #[ORM\Column(type: 'integer')]
    private int $descriptor;

    #[ORM\Column(type: 'string')]
    private string $resourcePresenter;

    #[ORM\Column(type: 'float')]
    private float $winRate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlotMachine(): ISlotMachine
    {
        return $this->slotMachine;
    }

    public function setSlotMachine(ISlotMachine $slotMachine): self
    {
        $this->slotMachine = $slotMachine;
        return $this;
    }

    public function getPrizeInLine(): float
    {
        return $this->prizeInLine;
    }

    public function setPrizeInLine(float $prizeInLine): ISlot
    {
        $this->prizeInLine = $prizeInLine;
        return $this;
    }

    public function getDescriptor(): int
    {
        return $this->descriptor;
    }

    public function setDescriptor(int $descriptor): ISlot
    {
        $this->descriptor = $descriptor;
        return $this;
    }

    public function getResourcePresenter(): string
    {
        return $this->resourcePresenter;
    }

    public function setResourcePresenter(string $resourcePresenter): self
    {
        $this->resourcePresenter = $resourcePresenter;
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
