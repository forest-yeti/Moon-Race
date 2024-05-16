<?php

namespace App\MoonRace\Slot\Action;

use App\MoonRace\Casino\Service\RandomNumberGenerator;
use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\Common\Game\Enum\GameTypeEnum;
use App\MoonRace\GameLog\Entity\GameLogCreateData;
use App\MoonRace\GameLog\Service\GameLogger;
use App\MoonRace\Slot\Contract\ISlotSpinData;
use App\MoonRace\Slot\Dto\SlotSpinResult;
use App\MoonRace\Slot\Entity\ISlot;
use App\MoonRace\Slot\Repository\ISlotMachineRepository;
use App\MoonRace\Slot\Repository\ISlotRepository;
use App\MoonRace\User\Repository\IUserGameRepository;
use App\MoonRace\Wallet\Service\WalletManager;
use Exception;

class SlotSpinAction
{
    public function __construct(
        private readonly IUserGameRepository    $userGameRepository,
        private readonly ISlotMachineRepository $slotMachineRepository,
        private readonly RandomNumberGenerator  $randomNumberGenerator,
        private readonly ISlotRepository        $slotRepository,
        private readonly GameLogger             $gameLogger,
        private readonly WalletManager          $walletManager
    ) {}

    /**
     * @throws RuntimeException
     */
    public function run(ISlotSpinData $data): SlotSpinResult
    {
        $userGame = $this->userGameRepository->findByUser($data->getTargetUser());

        if (
            $userGame === null ||
            $userGame->getType() !== GameTypeEnum::SlotMachine->value
        ) {
            throw new RuntimeException('You are not connected to the game');
        }

        $slotMachine = $this->slotMachineRepository->findById($userGame->getGameId());
        if ($slotMachine === null) {
            throw new RuntimeException('Slot machine not found');
        }

        if ($data->getBetStep() < 0 || $data->getBetStep() > $slotMachine->getBetStepCounter()) {
            throw new RuntimeException('Invalid bet step');
        }

        $spinCost = $slotMachine->getMinBet() * $data->getBetStep();

        if ($data->getTargetUser()->getWallet()->getBalance() < $spinCost) {
            throw new RuntimeException('Ops... Insufficient funds');
        }

        try {
            $randomNumber = $this->randomNumberGenerator->generate();
        } catch (Exception) {
            throw new RuntimeException('Random number generation error');
        }

        $slots = $this->slotRepository->findBySlotMachineSortByWinRateDesc($slotMachine);
        $winSlot = null;
        foreach ($slots as $slot) {
            if ($slot->getWinRate() > $randomNumber) {
                $winSlot = $slot;
            }
        }

        $this->walletManager->withdrawBalance(
            $data->getTargetUser()->getWallet(),
            $spinCost
        );

        $win = $winSlot !== null;

        if ($win) {
            $this->walletManager->addBalanceFromWinningPot(
                $data->getTargetUser()->getWallet(),
                 $spinCost * $winSlot->getPrizeInLine()
            );
        }

        $this->gameLogger->log(
            (new GameLogCreateData())
                ->setGameType(GameTypeEnum::SlotMachine->value)
                ->setGameId($userGame->getGameId())
                ->setUser($userGame->getUser())
                ->setWin($win)
                ->setRandomNumber($randomNumber)
        );

        return (new SlotSpinResult())
            ->setWin($win)
            ->setCurrentBalance($data->getTargetUser()->getWallet()->getBalance())
            ->setLines($this->buildLines($slots, $winSlot));
    }

    private function buildLines(array $slots, ?ISlot $winSlot): array
    {
        $descriptors = array_map(function (ISlot $slot) {
            return $slot->getDescriptor();
        }, $slots);
        $length = count($descriptors);

        $lines = [];
        for ($i = 0; $i < $length; $i++) {
            if ($winSlot !== null && intval($length / 2) === $i) {
                for ($j = 0; $j < $length; $j++) {
                    $lines[$i][] = $winSlot->getDescriptor();
                }
            } else {
                shuffle($descriptors);
                $lines[$i] = $descriptors;
            }
        }

        return $lines;
    }
}