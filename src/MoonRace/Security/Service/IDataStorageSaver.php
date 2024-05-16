<?php

namespace App\MoonRace\Security\Service;

interface IDataStorageSaver
{
    public function persist(object $saveableData): self;
    public function flush(): self;
    public function remove(object $removableData): self;
}