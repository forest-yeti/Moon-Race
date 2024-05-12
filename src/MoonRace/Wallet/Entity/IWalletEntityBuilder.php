<?php

namespace App\MoonRace\Wallet\Entity;

interface IWalletEntityBuilder
{
    public function build(): IWallet;
}