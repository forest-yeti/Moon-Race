<?php

namespace App\UI\Validator\Service;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator
{
    public function __construct(
        private readonly ValidatorInterface $validator
    ) {}

    public function validate(object $validatableObject): array
    {
        $errors = $this->validator->validate($validatableObject);

        $messages = [];
        foreach ($errors as $error) {
            $messages[] = [
                'field'   => $error->getPropertyPath(),
                'message' => $error->getMessage(),
            ];
        }

        return $messages;
    }
}