<?php

namespace TechCorp\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TechCorp\FrontBundle\Entity\Status;

class LoadStatusData implements FixtureInterface
{
    const MAX_NB_STATUS = 47;
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i<self::MAX_NB_STATUS; $i++ ){
            $status = new Status();
            $status->setContent($faker->text(250));
            $status->setDeleted($faker->boolean);

            $manager->persist($status);
        }
        
        $manager->flush();
    }

}
