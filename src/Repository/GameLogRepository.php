<?php

namespace App\Repository;

use App\Entity\GameLog;
use App\Entity\User;
use App\MoonRace\GameLog\Entity\IGameLog;
use App\MoonRace\GameLog\Repository\IGameLogRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameLog>
 */
class GameLogRepository extends ServiceEntityRepository implements IGameLogRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameLog::class);
    }

    /**
     * @return IGameLog[]
     */
    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('gl')
            ->where('gl.user = :user')
            ->getQuery()
            ->getResult();
    }

    public function countGames(User $user): int
    {
        return $this->createQueryBuilder('gl')
            ->select('COUNT(gl)')
            ->where('gl.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countLoseGames(User $user): int
    {
        return $this->createQueryBuilder('gl')
            ->select('COUNT(gl)')
            ->andWhere('gl.user = :user')
            ->setParameter('user', $user)
            ->andWhere('gl.win = 0')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
