<?php

namespace App\DataFixtures;

use App\Credit\Domain\Entity\Credit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CreditFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $credit = new Credit();
        $credit->setName('1 Year Credit');
        $credit->setTerm(12);
        $credit->setInterest(500);
        $credit->setSum(1000);
        $manager->persist($credit);
        $manager->flush();

        $credit = new Credit();
        $credit->setName('3 Year Credit');
        $credit->setTerm(36);
        $credit->setInterest(1500);
        $credit->setSum(3000);
        $manager->persist($credit);
        $manager->flush();
    }
}
