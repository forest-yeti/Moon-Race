<?php

namespace App\MoonRace\GameLog\Service;

use App\MoonRace\GameLog\Entity\GameLogCreateData;
use App\MoonRace\GameLog\Entity\IGameLogEntityBuilder;
use App\MoonRace\Security\Service\IDataStorageSaver;
use DateTime;

class GameLogger
{
    public function __construct(
        private readonly IGameLogEntityBuilder $gameLogEntityBuilder,
        private readonly IDataStorageSaver     $dataStorageSaver
    ) {}

    public function log(GameLogCreateData $data): void
    {
        $gameLog = ($this->gameLogEntityBuilder->build())
            ->setGameType($data->getGameType())
            ->setGameId($data->getGameId())
            ->setUser($data->getUser())
            ->setWin($data->isWin())
            ->setCreatedAt(new DateTime())
            ->setRandomNumber($data->getRandomNumber())
            ->setMetaData($data->getMetaData());

        $this
            ->dataStorageSaver
            ->persist($gameLog)
            ->flush();
    }
}