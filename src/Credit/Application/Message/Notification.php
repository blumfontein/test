<?php

namespace App\Credit\Application\Message;

use App\Client\Domain\Entity\Client;

readonly class Notification
{
    public function __construct(
        private Client $client,
        private string $smsContent,
    ) {
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getSmsContent(): string
    {
        return $this->smsContent;
    }
}