<?php

namespace App\Credit\Domain\Repository;

use App\Client\Domain\Entity\Client;
use App\Credit\Domain\Entity\Credit;
use App\Credit\Domain\Entity\Issuance;
use App\Credit\Domain\Entity\Scoring;
use Doctrine\DBAL\LockMode;

interface IssuanceRepositoryInterface
{
    public function find(mixed $id, LockMode|int|null $lockMode = null, int|null $lockVersion = null): object|null;

    public function createFromScoring(Scoring $scoring): Issuance;
}