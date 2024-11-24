<?php

namespace App\DataFixtures;

use App\Client\Domain\Entity\Client;
use App\Credit\Domain\Entity\Credit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    }
}
