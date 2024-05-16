<?php

namespace App\Infrastructure\Doctrine\Service;

use App\MoonRace\Security\Service\IDataStorageSaver;
use Doctrine\ORM\EntityManagerInterface;

class DataStorageSaver implements IDataStorageSaver
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function persist(object $saveableData): IDataStorageSaver
    {
        $this->entityManager->persist($saveableData);

        return $this;
    }

    public function flush(): IDataStorageSaver
    {
        $this->entityManager->flush();

        return $this;
    }

    public function remove(object $removableData): IDataStorageSaver
    {
        $this->entityManager->remove($removableData);
        return $this;
    }
}