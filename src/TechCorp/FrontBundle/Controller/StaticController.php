<?php
namespace TechCorp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StaticController extends Controller
{
    public function homepageAction()
    {
        $name = 'World';
        return $this->render(
            'TechCorpFrontBundle:Static:homepage.html.twig',
            array('name'=> $name)
        );
    }
    public function aboutAction()
    {
        return $this->render(
            'TechCorpFrontBundle:Static:about.html.twig'
        );
    }
}

