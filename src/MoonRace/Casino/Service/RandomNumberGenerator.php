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
    public function generate(float $precision = 100): float
    {
        return random_int(0, $precision) / $precision;
    }
}