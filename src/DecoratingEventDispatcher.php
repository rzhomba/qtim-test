<?php

namespace App;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;

#[AsDecorator(decorates: EventDispatcherInterface::class)]
class DecoratingEventDispatcher implements EventDispatcherInterface
{
    public function __construct(
        #[AutowireDecorated]
        private readonly EventDispatcherInterface $inner,
        protected LoggerInterface                 $logger
    )
    {
    }

    public function dispatch(object $event): void
    {
        $this->logger->info('Message: ' . $event->getMessage());
        $this->inner->dispatch($event);
    }
}