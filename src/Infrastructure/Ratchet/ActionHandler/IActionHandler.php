<?php

namespace App\Infrastructure\Ratchet\ActionHandler;

use App\Infrastructure\Ratchet\Input\Input;
use Ratchet\ConnectionInterface;

interface IActionHandler
{
    public function getActionName(): string;
    public function run(string $socketToken, ConnectionInterface $from, Input $input): bool;
}