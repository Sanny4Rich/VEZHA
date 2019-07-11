<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Repository\ContactsRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/{_locale}/category/{url}", name="category")
     */
    public function index(Request $request, ContactsRepository $contactsRepository,Categories $categories, ProductsRepository $productsRepository, CategoriesRepository $categoriesRepository)
    {
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);

        $products = $productsRepository->createQueryBuilder('m')
            ->innerJoin('m.categories', 's', 'WITH', 's = :category')
            ->addSelect('i')
            ->leftJoin('m.images', 'i')
            ->setParameter('category', $categories)
            ->getQuery()
            ->getResult();

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        return $this->render('category/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'contacts' => $contacts
        ]);
    }

    /**
     * @Route("/{_locale}/categories", name="categories")
     */
    public function categories(CategoriesRepository $categoriesRepository, Request $request, ContactsRepository $contactsRepository){
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);


        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isVisible IS NOT NULL')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();
        ;
        return $this->render('category/all.categories.html.twig', [
            'categories' => $categories,
            'contacts' => $contacts
        ]);
    }
}
