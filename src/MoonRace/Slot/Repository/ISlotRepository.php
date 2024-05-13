<?php

namespace App\MoonRace\Slot\Repository;

use App\MoonRace\Slot\Entity\ISlot;
use App\MoonRace\Slot\Entity\ISlotMachine;

interface ISlotRepository
{
    /**
     * @return ISlot[]
     */
    public function findBySlotMachine(ISlotMachine $slotMachine): array;

    /**
     * @return ISlot[]
     */
    public function findBySlotMachineSortByWinRateDesc(ISlotMachine $slotMachine): array;
}