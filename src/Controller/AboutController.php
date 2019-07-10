<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/{_locale}/about", name="about")
     */
    public function about(CategoriesRepository $categoriesRepository)
    {
        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        return $this->render('about/about.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{_locale}/contacts", name="contacts")
     */
    public function contacts(CategoriesRepository $categoriesRepository){
        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        return $this->render('about/contact.html.twig', [
            'categories'=> $categories
        ]);
    }
}
