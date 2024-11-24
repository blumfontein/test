<?php

namespace App\Client\Application\Command;

class CreateClientCommand
{
    public function __construct(
        public ?string $firstName,
        public ?string $lastName,
        public ?int $age = null,
        public ?string $ssn = null,
        public ?string $address = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?int $fico = null,
        public ?string $state = null,
        public ?int $income = null,
    ) {
    }
}
