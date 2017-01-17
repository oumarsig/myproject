<?php

namespace TechCorp\FrontBundle\Repository;

use Doctrine\ORM\EntityRepository;

class StatusRepository extends EntityRepository
{
    public function getStatusesAndUsers()
    {
        $em = $this->getEntityManager();
        //utilisation de DQL
        $requestStatusAndUsers = $em->createQuery('
                                        Select s, u
                                        From TechCorpFrontBundle:Status s 
                                        Join s.user u 
                                        Order by s.createdAt desc
                                        ');
        return $requestStatusAndUsers;
    }

    public function getUserTimeline($user)
    {
        $em = $this->_em;

        $requestUserTimeline = $em->createQuery('
                                        Select s, u, c 
                                        From TechCorpFrontBundle:Status s 
                                        Left Join s.comments c 
                                        Left Join c.user u 
                                        Where 
                                            s.user = :user 
                                            And s.deleted = false
                                        Order By
                                            s.createdAt Desc
                                    ')
                                    ->setParameter('user', $user);

        return $requestUserTimeline;
    }

    public function getFriendsTimeline($user)
    {
        $em = $this->getEntityManager();

        $requestFriendsTimeline =  $em->createQuery('
                                    Select s, u, c 
                                    From TechCorpFrontBundle:Status s 
                                    Left Join s.comments c 
                                    Left Join c.user u 
                                    Where s.user in (
                                        Select friends From TechCorpFrontBundle:User uf 
                                        Join uf.friends friends 
                                        Where uf = :user
                                        )
                                    Order By
                                        s.createdAt Desc
                                    ')
                                    ->setParameter('user', $user);

        return $requestFriendsTimeline;
    }
}