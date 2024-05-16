<?php

namespace App\MoonRace\GameLog\Repository;

use App\Entity\User;
use App\MoonRace\GameLog\Entity\IGameLog;

interface IGameLogRepository
{
    /**
     * @param User $user
     * @return IGameLog[]
     */
    public function findByUser(User $user): array;

    /**
     * @param User $user
     * @return int
     */
    public function countGames(User $user): int;

    /**
     * @param User $user
     * @return int
     */
    public function countLoseGames(User $user): int;
}