<?php

namespace App\MoonRace\Slot\Entity;

interface ISlot
{
    public function getSlotMachine(): ISlotMachine;
    public function setSlotMachine(ISlotMachine $slotMachine): self;

    public function getPrizeInLine(): float;
    public function setPrizeInLine(float $prizeInLine): self;

    public function getDescriptor(): int;
    public function setDescriptor(int $descriptor): self;

    public function getResourcePresenter(): string;
    public function setResourcePresenter(string $resourcePresenter): self;

    public function getWinRate(): float;
    public function setWinRate(float $winRate): self;
}