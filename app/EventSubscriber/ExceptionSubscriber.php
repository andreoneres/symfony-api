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
    $code = $exception->getCode() == 0 ? 500 : $exception->getCode();
    $message = $exception->getMessage();

    $response = new JsonResponse([
      "Error" => $message,
    ]);
    $response->setStatusCode($code);
    $event->setResponse($response);
  }
}
