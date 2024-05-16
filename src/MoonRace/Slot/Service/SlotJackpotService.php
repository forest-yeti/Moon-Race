<?php

namespace App\MoonRace\Slot\Service;

use App\MoonRace\Casino\Service\RandomNumberGenerator;
use App\MoonRace\GameLog\Repository\IGameLogRepository;
use App\MoonRace\Security\Service\IDataStorageSaver;
use App\MoonRace\Slot\Entity\ISlotMachine;
use App\MoonRace\User\Entity\IUser;
use DateTime;
use Exception;

class SlotJackpotService
{
    public function __construct(
        private readonly IGameLogRepository    $gameLogRepository,
        private readonly RandomNumberGenerator $randomNumberGenerator,
        private readonly IDataStorageSaver     $dataStorageSaver
    ) {}

    /**
     * @throws Exception
     */
    public function tryExecute(IUser $user, ISlotMachine $slotMachine): bool
    {
        if ($slotMachine->getSlotJackpot() === null) {
            return false;
        }

        $now = new DateTime();
        if ($slotMachine->getSlotJackpot()->getDrawDateFrom() > $now) {
            return false;
        }

        $allPlayedGames = $this->gameLogRepository->countGames($user);
        if ($slotMachine->getSlotJackpot()->getMinPlayerGames() > $allPlayedGames) {
            return false;
        }

        $loseGames = $this->gameLogRepository->countLoseGames($user);
        $losePercent = $loseGames / $allPlayedGames;
        if ($losePercent < $slotMachine->getSlotJackpot()->getPlayerLooseness()) {
            return false;
        }

        if ($this->randomNumberGenerator->generate() > $slotMachine->getSlotJackpot()->getWinRate()) {
            return false;
        }

        $slotJackpot = $slotMachine->getSlotJackpot();
        $slotMachine->setSlotJackpot(null);

        $this->dataStorageSaver->persist($slotMachine);
        $this->dataStorageSaver->remove($slotJackpot);
        $this->dataStorageSaver->flush();

        return true;
    }
}