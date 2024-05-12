<?php

namespace App\MoonRace\Wallet\Service;

use App\MoonRace\Wallet\Entity\IWallet;
use App\MoonRace\Wallet\Entity\IWalletEntityBuilder;

class WalletCreator
{
    public function __construct(
        private readonly IWalletEntityBuilder $walletEntityBuilder
    ) {}

    public function create(): IWallet
    {
        $wallet = $this->walletEntityBuilder->build();
        $wallet->setBalance(0);

        return $wallet;
    }
}