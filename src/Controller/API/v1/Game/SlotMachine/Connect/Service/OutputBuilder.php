<?php

namespace App\Controller\API\v1\Game\SlotMachine\Connect\Service;

use App\MoonRace\Slot\Entity\ISlotMachine;

class OutputBuilder
{
    public function build(ISlotMachine $slotMachine): array
    {
        return [
            'name'           => $slotMachine->getName(),
            'logo'           => $slotMachine->getLogo(),
            'minBet'         => $slotMachine->getMinBet(),
            'betStepCounter' => $slotMachine->getBetStepCounter(),
            'background'     => $slotMachine->getBackgroundTheme(),
        ];
    }
}