<?php

namespace App\Entity;

use App\MoonRace\Security\Entity\IUserSecurity;
use App\MoonRace\User\Entity\IUser;
use App\MoonRace\Wallet\Entity\IWallet;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements IUser, IUserSecurity, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 32)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'string', length: 255)]
    private string $avatar;

    #[ORM\Column(type: 'string', length: 255)]
    private string $password;

    #[ORM\ManyToOne(targetEntity: Wallet::class)]
    private Wallet $wallet;

    #[ORM\Column(type: 'string')]
    private string $socketToken;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): IUser
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): IUser
    {
        $this->email = $email;
        return $this;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): IUser
    {
        $this->avatar = $avatar;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getWallet(): IWallet
    {
        return $this->wallet;
    }

    public function setWallet(IWallet $wallet): IUser
    {
        $this->wallet = $wallet;
        return $this;
    }

    public function getSocketToken(): string
    {
        return $this->socketToken;
    }

    public function setSocketToken(string $socketToken): self
    {
        $this->socketToken = $socketToken;

        return $this;
    }
}
