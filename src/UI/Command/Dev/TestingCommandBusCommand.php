<?php

namespace App\UI\Command\Dev;

use App\Application\CommandBus\CommandBus;
use App\Application\CommandBus\TestCommand;
use App\Application\CommandBus\TestCommandHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestingCommandBusCommand extends Command
{
    protected static $defaultName = "app:dev:commandtest";
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
        parent::__construct(null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->commandBus->handle(new TestCommand());
    }
}
