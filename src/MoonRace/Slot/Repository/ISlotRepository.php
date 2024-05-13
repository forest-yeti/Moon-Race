<?php

namespace App\MoonRace\Slot\Repository;

use App\MoonRace\Slot\Entity\ISlot;
use App\MoonRace\Slot\Entity\ISlotMachine;

interface ISlotRepository
{
    /**
     * @param ISlotMachine $slotMachine
     * @return ISlot[]
     */
    public function findBySlotMachine(ISlotMachine $slotMachine): array;
}