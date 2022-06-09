<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('adouessono@yahoo.fr');
        $user->setFirstname('utilisateur');
        $user->setLastname('test');
        $user->setBirthdate(new \DateTime('11/08/1992'));
        $manager->persist($user);
        $manager->flush();
    }
}
