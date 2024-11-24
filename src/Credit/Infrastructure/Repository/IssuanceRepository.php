<?php

namespace App\Credit\Infrastructure\Repository;

use App\Client\Domain\Entity\Client;
use App\Credit\Domain\Entity\Credit;
use App\Credit\Domain\Entity\Issuance;
use App\Credit\Domain\Entity\Scoring;
use App\Credit\Domain\Repository\IssuanceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Credit>
 */
class IssuanceRepository extends ServiceEntityRepository implements IssuanceRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Credit::class);
    }

    public function issue(Client $client, Credit $credit): void
    {
        $client->addCredit($credit);

        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
    }

    public function createFromScoring(Scoring $scoring): Issuance
    {
        $issuance = new Issuance();
        $issuance->setCredit($scoring->credit);
        $issuance->setClient($scoring->client);
        $issuance->setInterest($scoring->interest);

        $this->getEntityManager()->persist($issuance);
        $this->getEntityManager()->flush();

        return $issuance;
    }
}
