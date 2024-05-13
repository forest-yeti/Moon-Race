<?php

namespace App\MoonRace\Casino\Service;

use Exception;

class RandomNumberGenerator
{
    /**
     * Генерирует случайное число в диапазоне от 0 до 1
     *
     * @throws Exception
     */
    public function generate(): float
    {
        return random_int(0, 100) / 100;
    }
}