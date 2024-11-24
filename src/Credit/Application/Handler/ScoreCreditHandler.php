<?php

namespace App\Credit\Application\Handler;

use App\Credit\Application\Query\ScoreCreditQuery;
use App\Credit\Domain\Entity\Scoring;

readonly class ScoreCreditHandler
{
    public function __construct(
    )
    {
    }

    public function handle(ScoreCreditQuery $query): Scoring
    {
        $isAllowed = true;

        if ($query->client->getFico() < 500) {
            $isAllowed = false;
        }

        if ($query->client->getIncome() < 1000) {
            $isAllowed = false;
        }

        if ($query->client->getAge() < 18 || $query->client->getAge() > 60) {
            $isAllowed = false;
        }

        if (!in_array($query->client->getState(), ['CA', 'NY', 'NV'])) {
            $isAllowed = false;
        }

        if (in_array($query->client->getState(), ['NY'])) {
            $isAllowed = (bool) random_int(0, 1);
        }

        $scoring = new Scoring();
        $scoring->client = $query->client;
        $scoring->credit = $query->credit;
        $scoring->isAllowed = $isAllowed;
        $scoring->interest = $query->credit->getInterest();

        if (in_array($query->client->getState(), ['CA'])) {
            $scoring->interest += 1149; // We preserve int instead of float to avoid float operations
        }

        return $scoring;
    }
}
