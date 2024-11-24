<?php

namespace App\Credit\Domain\Repository;

use App\Credit\Domain\Entity\Credit;
use Doctrine\DBAL\LockMode;

interface CreditRepositoryInterface
{
    public function find(mixed $id, LockMode|int|null $lockMode = null, int|null $lockVersion = null): object|null;
}