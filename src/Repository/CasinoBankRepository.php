<?php

namespace App\Repository;

use App\Entity\CasinoBank;
use App\MoonRace\CasinoBank\Entity\ICasinoBank;
use App\MoonRace\CasinoBank\Repository\ICasinoBankRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CasinoBank>
 */
class CasinoBankRepository extends ServiceEntityRepository implements ICasinoBankRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CasinoBank::class);
    }

    public function get(): ICasinoBank
    {
        return $this->createQueryBuilder('cb')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
