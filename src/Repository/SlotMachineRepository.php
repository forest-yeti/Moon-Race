<?php

namespace App\Repository;

use App\Entity\SlotMachine;
use App\MoonRace\Slot\Entity\ISlotMachine;
use App\MoonRace\Slot\Repository\ISlotMachineRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SlotMachine>
 */
class SlotMachineRepository extends ServiceEntityRepository implements ISlotMachineRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SlotMachine::class);
    }

    public function findById(int $id): ?ISlotMachine
    {
        return $this->createQueryBuilder('sm')
            ->where('sm.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
