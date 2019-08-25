<?php

namespace App\UI\Command\Dev;

use Mmalessa\CommandBus\CommandBus;
use App\Application\CommandBus\TestCommand;
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
        $this->commandBus->handle(TestCommand::create(1, 'Silifon'));
    }
}
