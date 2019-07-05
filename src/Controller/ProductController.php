<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/{locale}/product/{url}", name="product")
     */
    public function index(Products $products, ProductsRepository $productsRepository)
    {

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $products
        ]);
    }

    /**
     * @Route("/{locale}/products", name="products")
     */
    public function allProducts(ProductsRepository $productsRepository){
        $products = $productsRepository->createQueryBuilder('m')
            ->addSelect('i')
            ->leftJoin('m.images', 'i')
            ->getQuery()
            ->getResult();
        return $this->render('product/allprod.html.twig', [
            'products' => $products,
        ]);
    }
}
