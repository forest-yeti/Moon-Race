<?php

namespace App\MoonRace\Wallet\Service;

use App\MoonRace\Security\Service\IDataStorageSaver;
use App\MoonRace\Wallet\Entity\IWallet;

class WalletManager
{
    public function __construct(
        private readonly IDataStorageSaver $dataStorageSaver
    ) {}

    public function withdrawBalance(IWallet $wallet, float $value): void
    {
        $targetBalance = $wallet->getBalance() - $value;

        $wallet->setBalance($targetBalance);

        $this->dataStorageSaver->persist($wallet);
        $this->dataStorageSaver->flush();
    }

    public function addBalance(IWallet $wallet, float $value): void
    {
        $targetBalance = $wallet->getBalance() + $value;

        $wallet->setBalance($targetBalance);

        $this->dataStorageSaver->persist($wallet);
        $this->dataStorageSaver->flush();
    }
}