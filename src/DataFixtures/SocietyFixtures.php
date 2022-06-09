<?php

namespace App\DataFixtures;

use App\Entity\Society;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SocietyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 10;$i++) {
            
            $society = new Society();
            $society->setName("society$i");
            $manager->persist($society);
        }
        
        $manager->flush();
    }
}
