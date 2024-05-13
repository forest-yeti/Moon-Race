<?php

namespace App\Command\SocketServer;

use App\Infrastructure\Ratchet\Repository\ActionHandlerRepository;
use App\Infrastructure\Ratchet\Service\OutputBuilder;
use App\Infrastructure\Ratchet\SocketServer;
use App\MoonRace\User\Repository\IUserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

#[AsCommand(
    name: 'app:web-socket-server',
    description: 'Start the web socket server',
)]
class WebSocketServerCommand extends Command
{
    public function __construct(
        private readonly ActionHandlerRepository $actionHandlerRepository,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketServer($output, $this->actionHandlerRepository)
                )
            ),
            8081
        );

        $server->run();

        return Command::SUCCESS;
    }
}
