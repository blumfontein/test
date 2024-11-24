<?php

namespace App\Credit\Domain\Entity;

use App\Client\Domain\Entity\Client;

class Scoring
{
    public Client $client;
    public Credit $credit;
    public bool $isAllowed = false;
    public int $interest;
}
