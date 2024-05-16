<?php

namespace App\Infrastructure\Ratchet\ActionHandler\Game\SlotMachine\Spin;

use App\Entity\User;
use App\Infrastructure\Ratchet\ActionHandler\Game\SlotMachine\Spin\ValueObject\SlotSpinData;
use App\Infrastructure\Ratchet\ActionHandler\IActionHandler;
use App\Infrastructure\Ratchet\Input\Input;
use App\Infrastructure\Ratchet\Service\OutputBuilder;
use App\MoonRace\Slot\Action\SlotSpinAction;
use Exception;
use Ratchet\ConnectionInterface;

class SpinSlotMachineActionHandler implements IActionHandler
{
    public function __construct(
        private readonly SlotSpinAction $slotSpinAction,
        private readonly OutputBuilder  $outputBuilder
    ) {}

    public function getActionName(): string
    {
        return 'spin-slot-machine';
    }

    public function run(User $user, ConnectionInterface $from, Input $input): bool
    {
        $data = new SlotSpinData(
            $user,
            $input->get('bet_step')
        );

        try {
            $slotSpinResult = $this->slotSpinAction->run($data);
        } catch (Exception $e) {
            $from->send(
                $this->outputBuilder->build(
                    'Slot spin',
                    [
                        'errors' => [$e->getMessage()],
                    ]
                )
            );
            return false;
        }

        $from->send(
            $this->outputBuilder->build(
                'Slot spin',
                [
                    'win'       => $slotSpinResult->isWin(),
                    'lines'     => $slotSpinResult->getLines(),
                    'balance'   => $slotSpinResult->getCurrentBalance(),
                    'jackpot'   => $slotSpinResult->isWinJackpot(),
                    'free_spin' => $slotSpinResult->isCanFreeSpin(),
                ],
                true
            )
        );

        return true;
    }
}