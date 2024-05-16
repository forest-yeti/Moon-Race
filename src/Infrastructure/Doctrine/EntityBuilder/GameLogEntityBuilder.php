<?php

namespace App\Infrastructure\Doctrine\EntityBuilder;

use App\Entity\GameLog;
use App\MoonRace\GameLog\Entity\IGameLog;
use App\MoonRace\GameLog\Entity\IGameLogEntityBuilder;

class GameLogEntityBuilder implements IGameLogEntityBuilder
{
    public function build(): IGameLog
    {
        return new GameLog();
    }
}