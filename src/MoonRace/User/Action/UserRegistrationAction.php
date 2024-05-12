<?php

namespace App\MoonRace\User\Action;

use App\MoonRace\Common\Exception\RuntimeException;
use App\MoonRace\Security\Service\IDataStorageSaver;
use App\MoonRace\Security\Service\UserPasswordSecurity;
use App\MoonRace\User\Contract\IUserRegistrationData;
use App\MoonRace\User\Entity\IUserEntityBuilder;
use App\MoonRace\User\Repository\IUserRepository;
use App\MoonRace\Wallet\Service\WalletCreator;

class UserRegistrationAction
{
    public function __construct(
        private readonly IUserEntityBuilder   $userEntityBuilder,
        private readonly UserPasswordSecurity $userPasswordSecurity,
        private readonly IDataStorageSaver    $dataStorageSaver,
        private readonly IUserRepository      $userRepository,
        private readonly WalletCreator        $walletCreator,
        private readonly string               $userDefaultAvatar
    ) {}

    /**
     * @throws RuntimeException
     */
    public function run(IUserRegistrationData $data): void
    {
        $user = $this->userRepository->findByEmail($data->getEmail());
        if ($user !== null) {
            throw new RuntimeException('User with this email already exists');
        }

        $user = $this->userEntityBuilder->build();
        $wallet = $this->walletCreator->create();

        $user->setName($data->getName());
        $user->setEmail($data->getEmail());
        $user->setAvatar($this->userDefaultAvatar);
        $this->userPasswordSecurity->updatePassword($data->getPassword(), $user);
        $user->setWallet($wallet);

        $this
            ->dataStorageSaver
            ->persist($user)
            ->persist($wallet)
            ->flush();
    }
}