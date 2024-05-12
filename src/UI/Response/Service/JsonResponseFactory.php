<?php

namespace App\UI\Response\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseFactory
{
    public function factorySuccess(string $message = '', array $data = []): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'data'    => $data
        ], Response::HTTP_OK);
    }

    public function factoryFailed(string $message = '', array $data = []): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'data'    => $data
        ], Response::HTTP_FORBIDDEN);
    }
}