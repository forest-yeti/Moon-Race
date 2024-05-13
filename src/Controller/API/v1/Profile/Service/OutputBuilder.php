<?php

namespace App\Controller\API\v1\Profile\Service;

use App\MoonRace\User\Entity\IUser;

class OutputBuilder
{
    public function build(IUser $currentUser): array
    {
        return [
            'id'     => $currentUser->getId(),
            'name'   => $currentUser->getName(),
            'avatar' => $currentUser->getAvatar(),
            'wallet' => [
                'balance' => round($currentUser->getWallet()->getBalance(), 2),
            ]
        ];
    }
}