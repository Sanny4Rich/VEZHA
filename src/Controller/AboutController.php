<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/{locale}/about", name="about")
     */
    public function about()
    {
        return $this->render('about/about.html.twig', [
        ]);
    }

    /**
     * @Route("/{locale}/contacts", name="contacts")
     */
    public function contacts(){
        return $this->render('about/contact.html.twig');
    }
}
