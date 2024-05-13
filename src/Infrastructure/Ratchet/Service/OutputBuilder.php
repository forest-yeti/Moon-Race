<?php

namespace App\Infrastructure\Ratchet\Service;

class OutputBuilder
{
    public function build(string $message = '', array $data = [], bool $success = false): string
    {
        return json_encode([
            'message' => $message,
            'data'    => $data,
            'success' => $success,
        ]);
    }
}