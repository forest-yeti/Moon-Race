<?php

namespace App\MoonRace\Slot\Entity;

interface ISlotJackpot
{
    public function getJackpot(): float;
    public function setJackpot(float $jackpot): self;

    public function getWinRate(): float;
    public function setWinRate(float $winRate): self;
}