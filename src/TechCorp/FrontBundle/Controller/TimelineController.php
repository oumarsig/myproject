<?php
namespace TechCorp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechCorp\FrontBundle\Entity\Status;

class TimelineController extends Controller
{
    public function timelineAction()
    {
        # code...
        $em = $this->getDoctrine()->getManager();
        $statuses = $em->getRepository('TechCorpFrontBundle:Status')
                       ->getStatusesAndUsers()
                       ->getResult();

        return $this->render('TechCorpFrontBundle:Timeline:timeline.html.twig', 
                                    array('statuses' => $statuses)
                            );
    }
    
    public function userTimelineAction($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('TechCorpFrontBundle:User')
                       ->findOneById($userId); 
        if(!$user){
            $this->createNotFoundException("L'utilisateur n'existe pas pour l'instant!");
        }
        $statuses = $em->getRepository('TechCorpFrontBundle:Status')
                       ->getUserTimeline($user)
                       ->getResult();
                       /*->findBy(
                                array(
                                    'user' => $user,
                                    'deleted' => false,
                           )
                       );*/
        return $this->render('TechCorpFrontBundle:Timeline:user_timeline.html.twig',
                                    array(
                                        'user'     => $user,
                                        'statuses' => $statuses,
                                    )
                            );
    }

    public function friendsTimelineAction($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('TechCorpFrontBundle:User')
                       ->findOneById($userId); 
        if(!$user){
            $this->createNotFoundException("L'utilisateur n'a pas été trouvé!");
        }

        $statuses = $em->getRepository('TechCorpFrontBundle:Status')
                       ->getFriendsTimeline($user)
                       ->getResult();

        return $this->render('TechCorpFrontBundle:Timeline:friends_timeline.html.twig',
                                    array(
                                        'user'     => $user,
                                        'statuses' => $statuses,
                                    )
                            );
    }
}