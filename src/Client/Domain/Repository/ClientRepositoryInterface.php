<?php

namespace App\Client\Domain\Repository;

use App\Client\Domain\Entity\Client;
use Doctrine\DBAL\LockMode;

interface ClientRepositoryInterface
{
    public function find(mixed $id, LockMode|int|null $lockMode = null, int|null $lockVersion = null): object|null;

    public function save(Client $client): void;
}