<?php

namespace App\Infrastructure\Doctrine\EntityBuilder;

use App\Entity\Wallet;
use App\MoonRace\Wallet\Entity\IWallet;
use App\MoonRace\Wallet\Entity\IWalletEntityBuilder;

class WalletEntityBuilder implements IWalletEntityBuilder
{
    public function build(): IWallet
    {
        return new Wallet();
    }
}