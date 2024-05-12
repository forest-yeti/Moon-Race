<?php

namespace App\MoonRace\Wallet\Entity;

interface IWallet
{
    public function getBalance(): float;
    public function setBalance(float $balance): self;
}