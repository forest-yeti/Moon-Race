<?php

namespace App\MoonRace\Slot\Dto;

class SlotSpinResult
{
    private bool  $win;
    private float $currentBalance;
    private array $lines;
    private bool  $canFreeSpin = false;
    private bool  $winJackpot = false;

    public function isWin(): bool
    {
        return $this->win;
    }

    public function setWin(bool $win): self
    {
        $this->win = $win;

        return $this;
    }

    public function getCurrentBalance(): float
    {
        return $this->currentBalance;
    }

    public function setCurrentBalance(float $currentBalance): self
    {
        $this->currentBalance = $currentBalance;

        return $this;
    }

    public function getLines(): array
    {
        return $this->lines;
    }

    public function setLines(array $lines): self
    {
        $this->lines = $lines;

        return $this;
    }

    public function isCanFreeSpin(): bool
    {
        return $this->canFreeSpin;
    }

    public function setCanFreeSpin(bool $canFreeSpin): self
    {
        $this->canFreeSpin = $canFreeSpin;

        return $this;
    }

    public function isWinJackpot(): bool
    {
        return $this->winJackpot;
    }

    public function setWinJackpot(bool $winJackpot): self
    {
        $this->winJackpot = $winJackpot;

        return $this;
    }
}