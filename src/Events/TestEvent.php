<?php

namespace App\Events;

use Symfony\Contracts\EventDispatcher\Event;

class TestEvent extends Event
{
    public const NAME = 'test.event';

    /**
     * @param string $message
     */
    public function __construct(
        protected string $message
    )
    {
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}