<?php

namespace App\Repository;

use App\Entity\UserGame;
use App\MoonRace\User\Entity\IUser;
use App\MoonRace\User\Entity\IUserGame;
use App\MoonRace\User\Repository\IUserGameRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserGame>
 */
class UserGameRepository extends ServiceEntityRepository implements IUserGameRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserGame::class);
    }

    public function findByUser(IUser $user): ?IUserGame
    {
        return $this->createQueryBuilder('ug')
            ->where('ug.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
