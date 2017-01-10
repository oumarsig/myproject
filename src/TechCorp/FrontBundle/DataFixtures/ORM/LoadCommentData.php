<?php

namespace TechCorp\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TechCorp\FrontBundle\Entity\User;
use TechCorp\FrontBundle\Entity\Status;
use TechCorp\FrontBundle\Entity\Comment;

class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{
    const MAX_NB_COMMENTS = 9;

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
         for($i=0; $i < LoadStatusData::MAX_NB_STATUS; $i++){
             $status = $this->getReference('status' . $i);

             for($j=0; $j<self::MAX_NB_COMMENTS; $j++){
                 $comment = new Comment();
                 $comment->setContent($faker->text(255));
                 $comment->setStatus($status);
                 $comment->setUser($this->getReference('user' . rand(0,10)));

                 $manager->persist($comment);
             }
         }
         $manager->flush();
    }
    
    public function getOrder()
    {
        return 3;
    }
}