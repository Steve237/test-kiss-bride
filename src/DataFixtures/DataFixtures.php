<?php

namespace App\DataFixtures;

use App\Entity\Notes;
use App\Entity\Society;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DataFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {

            $society = new Society();
            $society->setName("society$i");
            $manager->persist($society);

            $note = new Notes();
            $note->setDate(new \DateTime("2022-06-06"))
                ->setAmount(10.50)
                ->setType('essence')
                ->setRegistrationDate(new \DateTime())
                ->setSociety($society);

            $manager->persist($note);
        }

        $manager->flush();
    }
}
