<?php

namespace App\MoonRace\User\Entity;

use App\Entity\Wallet;

interface IUser
{
    public function getId(): ?int;

    public function getName(): string;
    public function setName(string $name): self;

    public function getEmail(): string;
    public function setEmail(string $email): self;

    public function getAvatar(): string;
    public function setAvatar(string $avatar): self;

    public function getWallet(): Wallet;
    public function setWallet(Wallet $wallet): self;
}