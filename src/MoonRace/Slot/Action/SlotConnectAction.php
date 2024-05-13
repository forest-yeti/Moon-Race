<?php

namespace App\MoonRace\Slot\Action;

use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\Common\Game\Enum\GameTypeEnum;
use App\MoonRace\Security\Service\IAuthService;
use App\MoonRace\Slot\Entity\ISlotMachine;
use App\MoonRace\Slot\Repository\ISlotMachineRepository;
use App\MoonRace\User\Service\UserConnector;

class SlotConnectAction
{
    public function __construct(
        private readonly ISlotMachineRepository $slotMachineRepository,
        private readonly IAuthService           $authService,
        private readonly UserConnector          $userConnector
    ) {}

    /**
     * @throws RuntimeException
     */
    public function run(int $machineSlotId): ISlotMachine
    {
        $targetSlotMachine = $this->slotMachineRepository->findById($machineSlotId);
        if ($targetSlotMachine === null) {
            throw new RuntimeException('Slot machine not found');
        }

        $currentUser = $this->authService->getUser();
        if ($currentUser->getWallet()->getBalance() < $targetSlotMachine->getMinBet()) {
            throw new RuntimeException('Your balance is less than target');
        }

        $this->userConnector->connect(
            $currentUser,
            GameTypeEnum::SlotMachine,
            $targetSlotMachine->getId()
        );

        return $targetSlotMachine;
    }
}