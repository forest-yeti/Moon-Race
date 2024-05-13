<?php

namespace App\Infrastructure\Ratchet;

use App\Infrastructure\Ratchet\ActionHandler\ConnectActionHandler;
use App\Infrastructure\Ratchet\Input\Input;
use App\Infrastructure\Ratchet\Repository\ActionHandlerRepository;
use App\Infrastructure\Ratchet\Service\OutputBuilder;
use App\MoonRace\User\Repository\IUserRepository;
use Exception;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use RuntimeException;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use SplObjectStorage;
use Symfony\Component\Console\Output\OutputInterface;

class SocketServer implements MessageComponentInterface
{
    private SplObjectStorage $clients;

    public function __construct(
        private readonly OutputInterface         $consoleOutput,
        private readonly ActionHandlerRepository $actionHandlerRepository
    )
    {
        $this->clients = new SplObjectStorage();
    }

    function onOpen(ConnectionInterface $conn): void
    {
        $this->clients->attach($conn);

        $outputStyle = new OutputFormatterStyle('black', 'green');
        $this->consoleOutput->getFormatter()->setStyle('notify', $outputStyle);
        $this->consoleOutput->writeln('<notify>Connected</notify>');
        $this->consoleOutput->writeln(
            sprintf('<notify>Clients - %d</notify>', $this->clients->count())
        );
    }

    function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);

        $outputStyle = new OutputFormatterStyle('black', 'red');
        $this->consoleOutput->getFormatter()->setStyle('danger', $outputStyle);
        $this->consoleOutput->writeln('<danger>Close</danger>');
        $this->consoleOutput->writeln(
            sprintf('<danger>Clients - %d</danger>', $this->clients->count())
        );
    }

    function onError(ConnectionInterface $conn, Exception $e): void
    {
        // ...
    }

    function onMessage(ConnectionInterface $from, $msg): void
    {
        $payload = json_decode($msg, true);
        $input = new Input($payload);

        try {
            $actionHandler = $this->actionHandlerRepository->find($input->getAction());
            $actionHandler->run($input->get('socket_token'), $from, $input);
        } catch (RuntimeException) {
            // ...
        }
    }
}