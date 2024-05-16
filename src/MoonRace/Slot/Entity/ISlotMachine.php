<?php

namespace App\MoonRace\Slot\Entity;

use App\Entity\SlotJackpot;

interface ISlotMachine
{
    public function getId(): ?int;

    public function getName(): string;
    public function setName(string $name): self;

    public function getLogo(): string;
    public function setLogo(string $logo): self;

    public function getBackgroundTheme(): string;
    public function setBackgroundTheme(string $backgroundTheme): self;

    public function getMinBet(): float;
    public function setMinBet(float $minBet): self;

    public function getBetStepCounter(): int;
    public function setBetStepCounter(int $betStepCounter): self;

    public function getAudioBackground(): string;
    public function setAudioBackground(string $audioBackground): self;

    public function getSlotJackpot(): ?SlotJackpot;
    public function setSlotJackpot(?SlotJackpot $slotJackpot): self;
}