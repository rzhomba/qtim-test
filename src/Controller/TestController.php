<?php

namespace App\Controller;

use App\Events\TestEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/test')]
class TestController extends AbstractController
{
    #[Route('/event', name: 'event')]
    public function event(
        EventDispatcherInterface $eventDispatcher,
        #[MapQueryParameter] ?string $message = 'Сообщение не передано',
    ): JsonResponse
    {
        $event = new TestEvent($message);
        $eventDispatcher->dispatch($event);

        return $this->json([
            'msg' => 'Сообщение передано',
        ]);
    }
}
