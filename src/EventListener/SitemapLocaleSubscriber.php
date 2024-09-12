<?php

namespace App\EventListener;

use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Route;

class SitemapLocaleSubscriber implements EventSubscriberInterface
{
    public function __construct(private RouterInterface $router, private string $locales) {}

    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::class => 'onSitemapPopulate',
        ];
    }

    public function onSitemapPopulate(SitemapPopulateEvent $event): void
    {
        $routes = $this->router->getRouteCollection()->all();

        foreach (explode('|', $this->locales) as $locale) {
            if ($event->getSection() === $locale) {
                foreach ($routes as $routeName => $route) {
                    if ($this->isRouteSitemapEligible($route)) {
                        $url = $this->router->generate($routeName, ['_locale' => $locale], RouterInterface::ABSOLUTE_URL);
                        $priority =  $route->getOption('sitemap')['priority'];
                        $changefreq = $route->getOption('sitemap')['changefreq'];

                        $event->getUrlContainer()->addUrl(
                            new UrlConcrete($url, new \DateTime(), $changefreq, $priority),
                            $locale
                        );
                    }
                }
            }
        }
    }

    private function isRouteSitemapEligible(Route $route): bool
    {
        return $route->getOption('sitemap') !== null && $route->getOption('sitemap') !== false;
    }
}
