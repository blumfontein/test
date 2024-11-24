<?php

namespace App\Client\Application\Command;

use App\Client\Domain\Entity\Client;

class UpdateClientCommand extends CreateClientCommand
{
    public ?Client $client = null;

    public function __construct(?Client $client, ?string $firstName, ?string $lastName, ?int $age = null, ?string $ssn = null, ?string $address = null, ?string $email = null, ?string $phone = null, int $fico = null)
    {
        $this->client = $client;

        parent::__construct($firstName, $lastName, $age, $ssn, $address, $email, $phone, $fico);
    }
}
