<?php

namespace App\MoonRace\Slot\Contract;

use App\MoonRace\User\Entity\IUser;

interface ISlotSpinData
{
    public function getTargetUser(): IUser;
    public function getBetStep(): int;
}