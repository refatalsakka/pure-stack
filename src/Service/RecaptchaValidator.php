<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class RecaptchaValidator
{
    public function __construct(
        private HttpClientInterface $client,
        private string $secretKey
    ) {}

    public function validate(string $recaptchaResponse, string $userIp = null): bool
    {
        $response = $this->client->request(
            'POST',
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'body' => [
                    'secret' => $this->secretKey,
                    'response' => $recaptchaResponse,
                    'remoteip' => $userIp,
                ],
            ]
        );

        $data = $response->toArray();

        return $data['success'] ?? false;
    }
}
