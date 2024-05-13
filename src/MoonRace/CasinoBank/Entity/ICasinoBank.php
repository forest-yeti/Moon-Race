<?php

namespace App\MoonRace\CasinoBank\Entity;

interface ICasinoBank
{
    public function getWinningPot(): float;
    public function setWinningPot(float $winningPot): self;

    public function getPlayerLosePot(): float;
    public function setPlayerLosePot(float $playerLosePot): self;
}