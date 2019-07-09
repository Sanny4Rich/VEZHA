<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/{_locale}/category/{url}", name="category")
     */
    public function index(Categories $categories, ProductsRepository $productsRepository)
    {
        $products = $productsRepository->createQueryBuilder('m')
            ->innerJoin('m.categories', 's', 'WITH', 's = :category')
            ->addSelect('i')
            ->leftJoin('m.images', 'i')
            ->setParameter('category', $categories)
            ->getQuery()
            ->getResult();
        return $this->render('category/index.html.twig', [
            'products' => $products
        ]);
    }
}
