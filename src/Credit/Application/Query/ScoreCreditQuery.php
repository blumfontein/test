<?php

namespace App\Credit\Application\Query;

use App\Client\Domain\Entity\Client;
use App\Credit\Domain\Entity\Credit;

class ScoreCreditQuery
{
    public function __construct(
        public Client $client,
        public Credit $credit,
    ) {
    }
}
