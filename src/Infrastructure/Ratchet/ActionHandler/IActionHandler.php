<?php

namespace App\Infrastructure\Ratchet\ActionHandler;

use App\Entity\User;
use App\Infrastructure\Ratchet\Input\Input;
use Ratchet\ConnectionInterface;

interface IActionHandler
{
    public function getActionName(): string;
    public function run(User $user, ConnectionInterface $from, Input $input): bool;
}