<?php

namespace App\Controller\API\v1\Game\SlotMachine\Connect;

use App\Controller\API\v1\Game\SlotMachine\Connect\Service\OutputBuilder;
use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\Slot\Action\SlotConnectAction;
use App\UI\Response\Service\JsonResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends AbstractController
{
    public function __construct(
        private readonly JsonResponseFactory $jsonResponseFactory,
        private readonly SlotConnectAction   $slotConnectAction,
        private readonly OutputBuilder       $outputBuilder
    ) {}

    public function __invoke(int $slotMachineId): JsonResponse
    {
        try {
            $targetSlotMachine = $this->slotConnectAction->run($slotMachineId);
        } catch (RuntimeException $e) {
            return $this->jsonResponseFactory->factoryFailed(
                'Failed connect to slot machine',
                [
                    'errors' => [$e->getMessage()],
                ]
            );
        }

        return $this->jsonResponseFactory->factorySuccess(
            'Connected to slot machine',
            [
                'slotMachine' => $this->outputBuilder->build($targetSlotMachine),
            ]
        );
    }
}