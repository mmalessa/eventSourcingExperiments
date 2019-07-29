<?php
namespace App\Infrastructure\CommandBusBundle;

use ReflectionClass;
use InvalidArgumentException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterCommandBusCompilerPas implements CompilerPassInterface
{
    private $busService;
    private $serviceTag;
    private $subscriberInterface;

    public function __construct(string $busService, string $serviceTag, string $subscriberInterface)
    {
        $this->busService          = $busService;
        $this->serviceTag          = $serviceTag;
        $this->subscriberInterface = $subscriberInterface;
    }

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition($this->busService) && !$container->hasAlias($this->busService)) {
            return;
        }
        $busServiceDefinition = $container->findDefinition($this->busService);
        foreach ($container->findTaggedServiceIds($this->serviceTag) as $serviceId => $serviceAttributes) {
            $serviceDefinition = $container->getDefinition($serviceId);
            $handlerClass = $container->getParameterBag()->resolveValue($serviceDefinition->getClass());
            $reflectionClass = new ReflectionClass($handlerClass);
            if (!$reflectionClass->hasMethod('handle')) {
                throw new InvalidArgumentException(
                    sprintf('There must be a "handle" method in the "%s" service.', $serviceId)
                );
            }
            $commandClass = $reflectionClass->getMethod('handle')->getParameters()[0]->getClass()->getName();
            $busServiceDefinition->addMethodCall('subscribe', [new Reference($commandClass), new Reference($handlerClass)]);
        }
    }
}
