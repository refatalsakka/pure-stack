<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouterInterface;

class LocaleRedirectListener
{
    public function __construct(private RouterInterface $router, private string $defaultLocale) {}

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if ($request->isMethod('GET') && $request->getPathInfo() == '/') {
            $uri = $this->router->generate($request->attributes->get('_route'), array_merge(
                $request->attributes->get('_route_params'),
                ['_locale' => $this->defaultLocale]
            ));

            $event->setResponse(new RedirectResponse($uri));
        }
    }
}
