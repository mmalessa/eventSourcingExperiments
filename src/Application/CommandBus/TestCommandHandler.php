<?php

namespace App\Application\CommandBus;

class TestCommandHandler
{
    public function handle(TestCommand $command): void
    {
        echo "Handle TestCommand\n";
        printf("ID: %s\n", $command->id());
        printf("Name: %s\n", $command->name());
        var_dump($command->payload());
    }
}
