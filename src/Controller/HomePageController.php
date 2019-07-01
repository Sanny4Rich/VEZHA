<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\VarDumper\VarDumper;

class HomePageController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function toHome(){
        return $this->redirectToRoute('home_page');
    }
    /**
     * @Route("/{_locale}/", name="home_page", defaults={"locale" = "ua"}, requirements={"_locale" = "ua|ru|en" })
     */
    public function index(Request $request)
    {
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }
}
