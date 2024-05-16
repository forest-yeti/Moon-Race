<?php

namespace App\Controller\API\v1\Game\SlotMachine\GetList\Service;

use App\MoonRace\Slot\Entity\ISlotMachine;

class OutputBuilder
{
    public function build(ISlotMachine $slotMachine): array
    {
        return [
            'id'      => $slotMachine->getId(),
            'logo'    => $slotMachine->getLogo(),
            'name'    => $slotMachine->getName(),
            'min_bet' => $slotMachine->getMinBet(),
            'jackpot' => $slotMachine->getSlotJackpot()?->getJackpot(),
        ];
    }
}