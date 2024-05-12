<?php

namespace App\Entity;

use App\MoonRace\Wallet\Entity\IWallet;
use App\Repository\WalletRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WalletRepository::class)]
class Wallet implements IWallet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'float')]
    private float $balance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): IWallet
    {
        $this->balance = $balance;
        return $this;
    }
}
