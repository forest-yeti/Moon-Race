<?php

namespace App\MoonRace\Slot\Repository;

use App\MoonRace\Slot\Entity\ISlotMachine;

interface ISlotMachineRepository
{
    public function findById(int $id): ?ISlotMachine;

    /**
     * @return ISlotMachine[]
     */
    public function getAll(): array;
}