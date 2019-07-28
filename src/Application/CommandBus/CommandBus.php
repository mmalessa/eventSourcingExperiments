<?php
namespace App\Application\CommandBus;

use Assert\Assertion;

final class CommandBus
{
    private $commandHandlers;

    public function subscribe($commandClass, $handlerClass)
    {
        $this->commandHandlers[get_class($commandClass)] = $handlerClass;
    }
    public function handle($command): void
    {
        Assertion::isObject($command);
        $commandClassName = get_class($command);
        Assertion::keyExists($this->commandHandlers, $commandClassName);
        ($this->commandHandlers[$commandClassName])->handle($command);
    }
}
