<?php

namespace App\MoonRace\Security\ValueObject;

use DateTime;

class UserAuthToken
{
    public function __construct(
        private readonly string   $token,
        private readonly DateTime $expiresAt
    ) {}

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExpiresAt(): DateTime
    {
        return $this->expiresAt;
    }

    public function toArray(): array
    {
        return [
            'token'      => $this->getToken(),
            'expired_at' => $this->getExpiresAt()->getTimestamp(),
        ];
    }
}