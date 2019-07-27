<?php

namespace App\Domain\EventSourcing;

interface DomainEvent
{
    public function serialize(): array;
    public static function deserialize(array $data): AggregateRootInterface;
}
