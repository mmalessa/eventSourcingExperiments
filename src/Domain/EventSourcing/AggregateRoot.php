<?php

namespace App\Domain\EventSourcing;

abstract class AggregateRoot
{
    public function apply($event)
    {
        $method = $this->getApplyMethod($event);
        if (!method_exists($this, $method)) {
            return;
        }
        $this->$method($event);
    }

    private function getApplyMethod($event): string
    {
        $classParts = explode('\\', get_class($event));
        return 'apply'.end($classParts);
    }
}
