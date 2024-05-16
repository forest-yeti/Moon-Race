<?php

namespace App\MoonRace\Slot\Entity;

use DateTime;

interface ISlotJackpot
{
    public function getJackpot(): float;
    public function setJackpot(float $jackpot): self;

    public function getPlayerLooseness(): float;
    public function setPlayerLooseness(float $playerLooseness): self;

    public function getDrawDateFrom(): DateTime;
    public function setDrawDateFrom(DateTime $drawDateFrom): self;

    public function getMinPlayerGames(): int;
    public function setMinPlayerGames(int $minPlayerGames): self;

    public function getWinRate(): float;
    public function setWinRate(float $winRate): self;

    public function getLoseAccumulationPercent(): float;
    public function setLoseAccumulationPercent(float $loseAccumulationPercent): self;
}