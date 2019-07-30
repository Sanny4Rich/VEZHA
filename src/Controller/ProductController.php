<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Products;
use App\Repository\CategoriesRepository;
use App\Repository\ContactsRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{url}", defaults={"_locale" = "ua"}, name="product_nolocale")
     * @Route("/{_locale}/product/{url}", name="product")
     */
    public function index(Request $request, ContactsRepository $contactsRepository, Products $product, ProductsRepository $productsRepository, CategoriesRepository $categoriesRepository)
    {
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();

        $products = $productsRepository->createQueryBuilder('m')
            ->addSelect('t')
            ->leftJoin('m.productsTranslations', 't')
            ->addSelect('i')
            ->leftJoin('m.images', 'i')
            ->getQuery()
            ->getResult();

        return $this->render('product/index.html.twig', [
            'categories' => $categories,
            'product' => $product,
            'products' => $products,
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/products", defaults={"_locale" = "ua"}, name="products_nolocale")
     * @Route("/{_locale}/products", name="products")
     */
    public function allProducts(Request $request, ContactsRepository $contactsRepository,ProductsRepository $productsRepository, CategoriesRepository $categoriesRepository){
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];

        $products = $productsRepository->createQueryBuilder('m')
            ->addSelect('i')
            ->leftJoin('m.images', 'i')
            ->addSelect('t')
            ->leftJoin('m.productsTranslations', 't')
            ->getQuery()
            ->getResult();
        $categories = $categoriesRepository->createQueryBuilder('c')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();
        return $this->render('product/allprod.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'contacts' => $contacts
        ]);
    }
}
