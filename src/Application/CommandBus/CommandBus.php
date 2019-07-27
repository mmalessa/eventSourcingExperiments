<?php
namespace App\Application\CommandBus;

use Assert\Assertion;

final class CommandBus
{
    private $commandHandlers;

    public function subscribe(CommandHandler $commandHandler)
    {
        $this->commandHandlers[get_class($commandHandler)] = $commandHandler;
    }
    public function handle($command): void
    {
        Assertion::isObject($command);
        $handlerClassName = get_class($command) . 'Handler';
        Assertion::keyExists($this->commandHandlers, $handlerClassName);
        ($this->commandHandlers[$handlerClassName])->handle($command);
    }
}
