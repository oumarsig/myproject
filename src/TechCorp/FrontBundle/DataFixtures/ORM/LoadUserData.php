<?php

namespace TechCorp\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TechCorp\FrontBundle\Entity\User;
use TechCorp\FrontBundle\Entity\Status;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    const MAX_NB_USERS = 15;

    public function load(ObjectManager $manager)
    {
        //Une bibliotheque de generation aleatoire
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <self::MAX_NB_USERS; $i++){
            //instanciation d'un user 
            $user = new User();
            $user->setUsername($faker->username);

            $manager->persist($user);
            $this->addReference('user' . $i, $user);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}
