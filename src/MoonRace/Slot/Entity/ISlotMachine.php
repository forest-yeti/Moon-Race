<?php

namespace App\MoonRace\Slot\Entity;

interface ISlotMachine
{
    public function getId(): ?int;

    public function getBackgroundTheme(): string;
    public function setBackgroundTheme(string $backgroundTheme): self;

    public function getMinBet(): float;
    public function setMinBet(float $minBet): self;

    public function getBetStepCounter(): int;
    public function setBetStepCounter(int $betStepCounter): self;
}