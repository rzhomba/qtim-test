<?php

namespace App\Events;

use Symfony\Contracts\EventDispatcher\Event;

class TestEvent extends Event
{
    public const NAME = 'test.event';

    public function __construct(
        protected string $message
    )
    {
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}