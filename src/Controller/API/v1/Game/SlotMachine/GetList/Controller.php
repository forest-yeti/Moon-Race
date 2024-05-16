<?php

namespace App\Controller\API\v1\Game\SlotMachine\GetList;

use App\Controller\API\v1\Game\SlotMachine\GetList\Service\OutputBuilder;
use App\MoonRace\Slot\Action\SlotGetListAction;
use App\UI\Response\Service\JsonResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends AbstractController
{
    public function __construct(
        private readonly SlotGetListAction   $slotGetListAction,
        private readonly OutputBuilder       $outputBuilder,
        private readonly JsonResponseFactory $jsonResponseFactory
    ) {}

    public function __invoke(): JsonResponse
    {
        $slotMachines = $this->slotGetListAction->run();

        $result = [];
        foreach ($slotMachines as $slotMachine) {
            $result[] = $this->outputBuilder->build($slotMachine);
        }

        return $this->jsonResponseFactory->factorySuccess(
            'Slot machines games',
            [
                'slot_machines' => $result,
            ]
        );
    }
}