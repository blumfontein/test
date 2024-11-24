<?php

namespace App\Credit\Application\Command;

use App\Client\Domain\Entity\Client;
use App\Credit\Domain\Entity\Credit;

class IssueCreditCommand
{
    public function __construct(
        public Client $client,
        public Credit $credit,
    ) {
    }
}
