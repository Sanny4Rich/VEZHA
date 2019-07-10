<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/{_locale}/service/{url}", name="service")
     */
    public function index(Services $services, CategoriesRepository $categoriesRepository)
    {
        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        return $this->render('service/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
