<?php
namespace App\Application\CommandBus;

use Mmalessa\CommandBus\Command;
use Mmalessa\CommandBus\CommandTrait;

final class TestCommand implements Command
{
    use CommandTrait;

    public static function create(int $id, string $name)
    {
        return new self(
            [
                'id' => $id,
                'name' => $name
            ]
        );
    }

    public function id()
    {
        return $this->payload['id'];
    }

    public function name()
    {
        return $this->payload['name'];
    }
}
