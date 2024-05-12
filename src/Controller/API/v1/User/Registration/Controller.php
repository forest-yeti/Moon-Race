<?php

namespace App\Controller\API\v1\User\Registration;

use App\Controller\API\v1\User\Registration\Input\UserRegistrationData;
use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\User\Action\UserRegistrationAction;
use App\UI\Response\Service\JsonResponseFactory;
use App\UI\Validator\Service\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Controller extends AbstractController
{
    public function __construct(
        private readonly Validator              $validator,
        private readonly JsonResponseFactory    $jsonResponseFactory,
        private readonly UserRegistrationAction $userRegistrationAction
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $input = new UserRegistrationData($request);

        $errors = $this->validator->validate($input);
        if (count($errors) > 0) {
            return $this->jsonResponseFactory->factoryFailed(
                'Ops... Something went wrong with registration',
                [
                    'errors' => $errors
                ]
            );
        }

        try {
            $this->userRegistrationAction->run($input);
        } catch (RuntimeException $e) {
            return $this->jsonResponseFactory->factoryFailed(
                'Ops... Something went wrong with registration',
                [
                    'errors' => [$e->getMessage()],
                ]
            );
        }

        return $this->jsonResponseFactory->factorySuccess('User successful registration');
    }
}