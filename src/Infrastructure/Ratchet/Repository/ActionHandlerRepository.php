<?php

namespace App\Infrastructure\Ratchet\Repository;

use App\Infrastructure\Ratchet\ActionHandler\IActionHandler;
use App\MoonRace\Common\Exception\RuntimeException;

class ActionHandlerRepository
{
    /** @var IActionHandler[] */
    private array $actionHandlers = [];

    public function __construct(iterable $iterables)
    {
        foreach ($iterables as $item) {
            $this->actionHandlers[] = $item;
        }
    }

    /**
     * @throws RuntimeException
     */
    public function find(string $actionName): IActionHandler
    {
        foreach ($this->actionHandlers as $actionHandler) {
            if ($actionHandler->getActionName() === $actionName) {
                return $actionHandler;
            }
        }

        throw new RuntimeException('Action handler not found');
    }
}