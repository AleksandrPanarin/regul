<?php

namespace App\Services\Mailers;

use App\Services\IMailer;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class Mailer implements IMailer
{
    /**
     * @var \Vonage\Client
     */
    private $client;

    /**
     * Mailer constructor.
     */
    public function __construct()
    {
        $basic = new Basic("eb265df0", "pUCli4BhkAnu9rDO");
        $this->client = new Client($basic);
    }

    /**
     * @param string $phoneNumber
     * @param string $text
     * @throws Client\Exception\Exception
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function sendTo(string $phoneNumber, string $text): void
    {
        $response = $this->client->sms()->send(
            new SMS($phoneNumber, 'Test company', $text)
        );
        $message = $response->current();
        if ($message->getStatus() != 0) {
            throw new \Exception("The message failed with status: " . $message->getStatus());
        }
    }
}
