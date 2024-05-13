<?php

namespace App\MoonRace\CasinoBank\Repository;

use App\MoonRace\CasinoBank\Entity\ICasinoBank;

interface ICasinoBankRepository
{
    public function get(): ICasinoBank;
}