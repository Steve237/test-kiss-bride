<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $password = $this->encoder->hashPassword($user, 'test');
        $user->setEmail('adouessono@yahoo.fr')
            ->setFirstname('utilisateur')
            ->setLastname('test')
            ->setPassword($password)
            ->setBirthdate(new \DateTime('11/08/1992'));
        
        $manager->persist($user);
        $manager->flush();
    }
}
