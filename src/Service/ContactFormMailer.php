<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactFormMailer
{
    public function __construct(
        private MailerInterface $mailer,
        private string $recipient,
        private string $from
    ) {}

    public function send(string $name, string $email, string $number, string $message): void
    {
        $email = (new Email())
            ->from($this->from)
            ->to($this->recipient)
            ->subject('Sleeky Code Contact')
            ->html("Name: {$name}<br>{$message}<br>Number: {$number}<br>Email: {$email}");

        try {
            $this->mailer->send($email);
        } catch (\Exception $e) {
            throw new \RuntimeException('Email sending failed: ' . $e->getMessage());
        }
    }
}
