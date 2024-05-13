<?php

namespace App\Controller\API\v1\User\Login;

use App\Controller\API\v1\User\Login\Input\UserLoginData;
use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\User\Action\UserLoginAction;
use App\UI\Response\Service\JsonResponseFactory;
use App\UI\Validator\Service\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Controller extends AbstractController
{
    public function __construct(
        private readonly UserLoginAction     $userLoginAction,
        private readonly JsonResponseFactory $jsonResponseFactory,
        private readonly Validator           $validator
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $input = new UserLoginData($request);

        $errors = $this->validator->validate($input);
        if (count($errors) > 0) {
            return $this->jsonResponseFactory->factoryFailed(
                'Ops... Something went wrong with login',
                [
                    'errors' => $errors
                ]
            );
        }

        try {
            $userAuth = $this->userLoginAction->run($input);
        } catch (RuntimeException $e) {
            return $this->jsonResponseFactory->factoryFailed(
                'Ops... Something went wrong with login',
                [
                    'errors' => [$e->getMessage()],
                ]
            );
        }

        return $this->jsonResponseFactory->factorySuccess(
            'User successful login',
            [
                'auth' => $userAuth->toArray(),
            ]
        );
    }
}