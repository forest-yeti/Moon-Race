<?php

namespace App\MoonRace\Wallet\Service;

use App\MoonRace\CasinoBank\Repository\ICasinoBankRepository;
use App\MoonRace\Security\Service\IDataStorageSaver;
use App\MoonRace\Wallet\Entity\IWallet;

class WalletManager
{
    public function __construct(
        private readonly IDataStorageSaver     $dataStorageSaver,
        private readonly ICasinoBankRepository $casinoBankRepository
    ) {}

    public function withdrawBalance(IWallet $wallet, float $userWithdrawValue, ?float $losePot = null): void
    {
        if ($losePot === null) {
            $losePot = $userWithdrawValue;
        }

        $casinoBank = $this->casinoBankRepository->get();
        $casinoBank->setPlayerLosePot(
            $casinoBank->getPlayerLosePot() + $losePot
        );

        $targetBalance = $wallet->getBalance() - $userWithdrawValue;
        $wallet->setBalance($targetBalance);

        $this->dataStorageSaver->persist($casinoBank);
        $this->dataStorageSaver->persist($wallet);
        $this->dataStorageSaver->flush();
    }

    public function addBalanceFromWinningPot(IWallet $wallet, float $value): void
    {
        $casinoBank = $this->casinoBankRepository->get();
        $casinoBank->setWinningPot(
            $casinoBank->getWinningPot() - $value
        );

        $wallet->setBalance(
            $wallet->getBalance() + $value
        );

        $this->dataStorageSaver->persist($casinoBank);
        $this->dataStorageSaver->persist($wallet);
        $this->dataStorageSaver->flush();
    }
}