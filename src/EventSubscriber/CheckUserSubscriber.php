<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Security;

class CheckUserSubscriber implements EventSubscriberInterface
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        // Get current path
        $route = $event->getRequest()->getpathInfo();

        // Get current user
        $user = $this->security->getUser();

        if (strpos($route, "api/notes") || strpos($route, "api/societies")) {

            // Return error if current user id is not 1
            if ($user !== null && $user->getId() !== 1) {
                $error = new AccessDeniedHttpException('Unauthorized request.');
                throw $error;
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            'kernel.request' => 'onKernelRequest'
        );
    }
}
