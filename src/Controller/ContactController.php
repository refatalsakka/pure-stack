<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Form\Model\ContactFormModel;
use App\Service\RecaptchaValidator;
use App\Service\ContactFormMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    public function index(
        Request $request,
        RecaptchaValidator $recaptchaValidator,
        ContactFormMailer $contactFormMailer,

    ): JsonResponse {
        $contactFormModel = new ContactFormModel();
        $form = $this->createForm(ContactFormType::class, $contactFormModel);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return new JsonResponse(['error' => 'Invalid data. Please try again.'], 400);
        }

        if (!$recaptchaValidator->validate(
            $request->get('g-recaptcha-response'),
            $request->getClientIp()
        )) {
            return new JsonResponse(['error' => 'Invalid reCAPTCHA. Please try again.'], 400);
        }

        try {
            $contactFormMailer->send(
                $contactFormModel->getName(),
                $contactFormModel->getEmail(),
                $contactFormModel->getNumber(),
                $contactFormModel->getMessage(),
            );
        } catch (\RuntimeException $e) {
            return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
        }

        return new JsonResponse(['success' => 1], 200);
    }
}
