<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface {

  public static function getSubscribedEvents() {
    return [
      KernelEvents::EXCEPTION => [
          ['onKernelException', 0]
      ]
    ];
  }

  public function onKernelException(ExceptionEvent $event) {

    $exception = $event->getThrowable();
    $response = new JsonResponse([
      "Error" => $exception->getMessage(),
    ]);
    $response->setStatusCode($exception->getCode());
    $event->setResponse($response);
  }
}
