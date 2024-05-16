<?php

namespace App\MoonRace\GameLog\Entity;

interface IGameLogEntityBuilder
{
    public function build(): IGameLog;
}