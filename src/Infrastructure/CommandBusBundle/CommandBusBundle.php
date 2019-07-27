<?php

namespace App\Infrastructure\CommandBusBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CommandBusBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(
            new RegisterCommandBusCompilerPas(
                'app.command_bus',
                'app.command_handler',
                \App\Application\CommandBus\CommandHandler::class
            )
        );
    }
}
