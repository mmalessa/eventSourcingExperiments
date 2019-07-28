<?php

namespace App\Application\CommandBus;

class TestCommandHandler
{
    public function handle(TestCommand $command): void
    {
        echo "Handle TestCommand\n";
        print_r($command);
    }
}
