<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UrlLocaleExtension extends AbstractExtension
{
    public function __construct(private RequestStack $requestStack) {}

    public function getFilters()
    {
        return [
            new TwigFilter('locale_in_url', [$this, 'localeInUrl']),
        ];
    }

    public function localeInUrl(string $path)
    {
        $request = $this->requestStack->getCurrentRequest();
        $currentLocale = $request->getLocale();

        if (strpos($path, "/$currentLocale/") === false) {
            return '/' . $currentLocale . $path;
        }

        return $path;
    }
}
