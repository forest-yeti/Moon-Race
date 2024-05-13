<?php

namespace App\Repository;

use App\Entity\Slot;
use App\MoonRace\Slot\Entity\ISlotMachine;
use App\MoonRace\Slot\Repository\ISlotRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Slot>
 */
class SlotRepository extends ServiceEntityRepository implements ISlotRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Slot::class);
    }

    public function findBySlotMachine(ISlotMachine $slotMachine): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.slotMachine = :slotMachine')
            ->setParameter('slotMachine', $slotMachine)
            ->getQuery()
            ->getResult();
    }
}
