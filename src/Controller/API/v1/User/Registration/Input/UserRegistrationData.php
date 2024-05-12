<?php

namespace App\Controller\API\v1\User\Registration\Input;

use App\MoonRace\User\Contract\IUserRegistrationData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationData implements IUserRegistrationData
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 3, max: 32)]
    private ?string $name;

    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 8)]
    private ?string $password;

    public function __construct(Request $request)
    {
        $this->name = $request->get('name');
        $this->email = $request->get('email');
        $this->password = $request->get('password');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}