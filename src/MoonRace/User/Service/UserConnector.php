<?php

namespace App\MoonRace\User\Service;

use App\Entity\UserGame;
use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\Common\Game\Enum\GameTypeEnum;
use App\MoonRace\Security\Service\IDataStorageSaver;
use App\MoonRace\User\Entity\IUser;
use App\MoonRace\User\Entity\IUserGameEntityBuilder;
use App\MoonRace\User\Repository\IUserGameRepository;

class UserConnector
{
    public function __construct(
        private readonly IUserGameRepository    $userGameRepository,
        private readonly IDataStorageSaver      $dataStorageSaver,
        private readonly IUserGameEntityBuilder $userGameEntityBuilder
    ) {}

    /**
     * @throws RuntimeException
     */
    public function connect(IUser $user, GameTypeEnum $gameType, int $gameId): void
    {
        $userGame = $this->userGameRepository->findByUser($user);
        if ($userGame !== null) {
            throw new RuntimeException('You are already playing another game');
        }

        $userGame = $this->userGameEntityBuilder->build();
        $userGame->setUser($user);
        $userGame->setType($gameType->value);
        $userGame->setGameId($gameId);

        $this->dataStorageSaver->persist($userGame);
        $this->dataStorageSaver->flush();
    }
}