<?php

namespace App\Infrastructure\Ratchet\ActionHandler\Game\SlotMachine\Spin\ValueObject;

use App\Entity\User;
use App\MoonRace\Slot\Contract\ISlotSpinData;
use App\MoonRace\User\Entity\IUser;

class SlotSpinData implements ISlotSpinData
{
    public function __construct(
        private readonly User $targetUser,
        private readonly int  $betStep
    ) {}

    public function getTargetUser(): User
    {
        return $this->targetUser;
    }

    public function getBetStep(): int
    {
        return $this->betStep;
    }
}