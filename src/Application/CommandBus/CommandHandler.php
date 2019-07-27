<?php
namespace App\Application\CommandBus;

interface CommandHandler
{
    public function handle($command): void;
}
