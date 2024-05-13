<?php

namespace App\MoonRace\Security\Service;

use App\MoonRace\Security\Entity\IUserSecurity;
use Ramsey\Uuid\Uuid;

class UserSocketTokenSecurity
{
    public function generate(IUserSecurity $user): void
    {
        $user->setSocketToken(Uuid::uuid4());
    }
}