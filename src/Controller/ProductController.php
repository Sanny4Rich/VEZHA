<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products")
     */
    public function to_products(){
        return $this->redirectToRoute('products');
    }

    /**
     * @Route("/{_locale}/product/{url}", name="product")
     */
    public function index(Products $products, ProductsRepository $productsRepository, CategoriesRepository $categoriesRepository)
    {
        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        return $this->render('product/index.html.twig', [
            'categories' => $categories,
            'product' => $products
        ]);
    }

    /**
     * @Route("/{_locale}/products", name="products")
     */
    public function allProducts(ProductsRepository $productsRepository, CategoriesRepository $categoriesRepository){
        $products = $productsRepository->createQueryBuilder('m')
            ->addSelect('i')
            ->leftJoin('m.images', 'i')
            ->getQuery()
            ->getResult();
        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        return $this->render('product/allprod.html.twig', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
