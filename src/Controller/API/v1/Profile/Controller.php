<?php

namespace App\Controller\API\v1\Profile;

use App\Controller\API\v1\Profile\Service\OutputBuilder;
use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\Security\Service\IAuthService;
use App\UI\Response\Service\JsonResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends AbstractController
{
    public function __construct(
        private readonly IAuthService        $authService,
        private readonly OutputBuilder       $outputBuilder,
        private readonly JsonResponseFactory $jsonResponseFactory
    ) {}

    public function __invoke(): JsonResponse
    {
        try {
            $currentUser = $this->authService->getUser();
        } catch (RuntimeException $e) {
            return $this->jsonResponseFactory->factoryFailed('User profile', [
                'errors' => [$e->getMessage()],
            ]);
        }

        return $this->jsonResponseFactory->factorySuccess('User profile', [
            'profile' => $this->outputBuilder->build($currentUser),
        ]);
    }
}