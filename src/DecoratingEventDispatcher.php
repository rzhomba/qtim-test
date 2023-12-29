<?php

namespace App;

use App\Events\TestEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;

#[AsDecorator(decorates: EventDispatcherInterface::class)]
class DecoratingEventDispatcher implements EventDispatcherInterface
{
    /**
     * @param EventDispatcherInterface $inner
     * @param LoggerInterface $logger
     */
    public function __construct(
        #[AutowireDecorated]
        private readonly EventDispatcherInterface $inner,
        protected LoggerInterface                 $logger
    )
    {
    }

    /**
     * @param object $event
     * @return object
     */
    public function dispatch(object $event): object
    {
        if ($event instanceof TestEvent) {
            $this->logger->info('Message: ' . $event->getMessage());
        }

        $this->inner->dispatch($event);
        return $event;
    }
}