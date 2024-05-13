<?php

namespace App\Infrastructure\Ratchet\Service;

class OutputBuilder
{
    public function build(string $message = '', array $data = [], bool $result = false): string
    {
        return json_encode([
            'message' => $message,
            'data'    => $data,
            'result'  => $result,
        ]);
    }
}