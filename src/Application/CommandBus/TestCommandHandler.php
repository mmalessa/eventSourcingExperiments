<?php

namespace App\Application\CommandBus;

class TestCommandHandler implements CommandHandler
{
    public function handle($command): void
    {
        echo "Handle TestCommand\n";
    }
}
