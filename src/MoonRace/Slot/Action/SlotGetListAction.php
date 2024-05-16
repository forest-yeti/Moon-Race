<?php

namespace App\MoonRace\Slot\Action;

use App\MoonRace\Slot\Entity\ISlotMachine;
use App\MoonRace\Slot\Repository\ISlotMachineRepository;

class SlotGetListAction
{
    public function __construct(
        private readonly ISlotMachineRepository $slotMachineRepository
    ) {}

    /**
     * @return ISlotMachine[]
     */
    public function run(): array
    {
        return $this->slotMachineRepository->getAll();
    }
}