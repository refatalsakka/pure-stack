<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class StaticPageController extends AbstractController
{
    public function imprint(): Response
    {
        return $this->render('imprint/index.html.twig');
    }

    public function privacyPolicy(): Response
    {
        return $this->render('privacy-policy/index.html.twig');
    }

    public function termsAndConditions(): Response
    {
        return $this->render('terms-and-conditions/index.html.twig');
    }
}
