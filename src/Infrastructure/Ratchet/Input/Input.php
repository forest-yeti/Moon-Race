<?php

namespace App\Infrastructure\Ratchet\Input;

use App\MoonRace\Common\Exception\RuntimeException;

class Input
{
    private string $action;
    private array  $data = [];

    public function __construct(array $input)
    {
        if (isset($input['action'])) {
            $this->action = $input['action'];
        }

        if (isset($input['data'])) {
            $this->data = $input['data'];
        }
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function get(string $key): mixed
    {
        return $this->getData()[$key];
    }
}