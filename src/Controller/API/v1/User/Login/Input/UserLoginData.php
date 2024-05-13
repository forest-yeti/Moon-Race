<?php

namespace App\Controller\API\v1\User\Login\Input;

use App\MoonRace\User\Contract\IUserLoginData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UserLoginData implements IUserLoginData
{
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email;

    #[Assert\NotBlank]
    private ?string $password;

    public function __construct(Request $request)
    {
        $this->email = $request->get('email');
        $this->password = $request->get('password');
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