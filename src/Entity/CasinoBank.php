<?php

namespace App\Entity;

use App\MoonRace\CasinoBank\Entity\ICasinoBank;
use App\Repository\CasinoBankRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CasinoBankRepository::class)]
class CasinoBank implements ICasinoBank
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'float')]
    private float $winningPot;

    #[ORM\Column(type: 'float')]
    private float $playerLosePot;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWinningPot(): float
    {
        return $this->winningPot;
    }

    public function setWinningPot(float $winningPot): self
    {
        $this->winningPot = $winningPot;

        return $this;
    }

    public function getPlayerLosePot(): float
    {
        return $this->playerLosePot;
    }

    public function setPlayerLosePot(float $playerLosePot): self
    {
        $this->playerLosePot = $playerLosePot;

        return $this;
    }
}
