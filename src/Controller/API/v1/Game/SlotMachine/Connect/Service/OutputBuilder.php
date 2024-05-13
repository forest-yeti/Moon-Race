<?php

namespace App\Controller\API\v1\Game\SlotMachine\Connect\Service;

use App\MoonRace\Slot\Entity\ISlotMachine;
use App\MoonRace\Slot\Repository\ISlotRepository;

class OutputBuilder
{
    public function __construct(
        private readonly ISlotRepository $slotRepository
    ) {}

    public function build(ISlotMachine $slotMachine): array
    {
        $slots = $this->slotRepository->findBySlotMachine($slotMachine);

        $slotsOutput = [];
        foreach ($slots as $slot) {
            $slotsOutput[] = [
                'resource' => $slot->getResourcePresenter()
            ];
        }

        return [
            'name'            => $slotMachine->getName(),
            'logo'            => $slotMachine->getLogo(),
            'minBet'          => $slotMachine->getMinBet(),
            'betStepCounter'  => $slotMachine->getBetStepCounter(),
            'background'      => $slotMachine->getBackgroundTheme(),
            'audioBackground' => $slotMachine->getAudioBackground(),
            'slots'           => $slotsOutput,
        ];
    }
}