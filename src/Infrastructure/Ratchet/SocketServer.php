<?php

namespace App\Infrastructure\Ratchet;

use App\Entity\User;
use App\Infrastructure\Ratchet\Input\Input;
use App\Infrastructure\Ratchet\Repository\ActionHandlerRepository;
use App\MoonRace\User\Repository\IUserRepository;
use App\MoonRace\User\Service\UserConnector;
use Exception;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use RuntimeException;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\OutputInterface;

class SocketServer implements MessageComponentInterface
{
    private array $authorizedClients = [];

    public function __construct(
        private readonly UserConnector           $userConnector,
        private readonly IUserRepository         $userRepository,
        private readonly OutputInterface         $consoleOutput,
        private readonly ActionHandlerRepository $actionHandlerRepository
    ) {}

    function onOpen(ConnectionInterface $conn): void
    {
        $outputStyle = new OutputFormatterStyle('black', 'green');
        $this->consoleOutput->getFormatter()->setStyle('notify', $outputStyle);
        $this->consoleOutput->writeln('<notify>Connected</notify>');
    }

    function onClose(ConnectionInterface $conn): void
    {
        $this->disconnect($conn);

        $outputStyle = new OutputFormatterStyle('black', 'red');
        $this->consoleOutput->getFormatter()->setStyle('danger', $outputStyle);
        $this->consoleOutput->writeln('<danger>Close</danger>');
    }

    function onError(ConnectionInterface $conn, Exception $e): void
    {
        $this->disconnect($conn);
    }

    function onMessage(ConnectionInterface $from, $msg): void
    {
        $payload = json_decode($msg, true);
        $input = new Input($payload);

        $user = $this->userRepository->findBySocketToken($input->get('socket_token'));
        if ($user === null) {
            return;
        }

        if ($input->getAction() === 'connect')
        {
            $this->connect($user, $from);
            return;
        }
        else if ($input->getAction() === 'disconnect')
        {
            $this->disconnect($from);
            return;
        }

        try {
            $actionHandler = $this->actionHandlerRepository->find($input->getAction());
            $actionHandler->run($user, $from, $input);
        } catch (RuntimeException) {
            // ...
        }
    }

    private function connect(User $user, ConnectionInterface $from): void
    {
        $this->authorizedClients[$user->getSocketToken()] = $from;
    }

    private function disconnect(ConnectionInterface $conn): void
    {
        foreach ($this->authorizedClients as $socketToken => $client) {
            if ($client === $conn) {
                $user = $this->userRepository->findBySocketToken($socketToken);
                if ($user === null) {
                    break;
                }

                $this->userConnector->disconnect($user);
                unset($this->authorizedClients[$socketToken]);

                break;
            }
        }
    }
}