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

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{url}", defaults={"_locale" = "ua"}, name="category_nolocale")
     * @Route("/{_locale}/category/{url}", name="category")
     */
    public function index(Request $request, ContactsRepository $contactsRepository,Categories $categories, ProductsRepository $productsRepository, CategoriesRepository $categoriesRepository)
    {
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];
        $products = $productsRepository->createQueryBuilder('m')
            ->innerJoin('m.categories', 's', 'WITH', 's = :category')
            ->addSelect('i')
            ->leftJoin('m.images', 'i')
            ->addSelect('t')
            ->leftJoin('m.productsTranslations', 't')
            ->setParameter('category', $categories)
            ->getQuery()
            ->getResult();

        $category = $categoriesRepository->createQueryBuilder('c')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();

        $parent = $categories->getParent();

        return $this->render('category/index.html.twig', [
            'products' => $products,
            'categories' => $category,
            'contacts' => $contacts,
            'par' => $parent,
            'cat' => $categories
        ]);
    }

    /**
     * @Route("/categories", defaults={"_locale" = "ua"}, name="categories_nolocale")
     * @Route("/{_locale}/categories", name="categories")
     */
    public function categories(CategoriesRepository $categoriesRepository, Request $request, ContactsRepository $contactsRepository){
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isVisible = 1')
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

    /**
     * @Route("/categories/{url}", defaults={"_locale" = "ua"}, name="categoriesSecond_nolocale")
     * @Route("/{_locale}/categories/{url}", name="categoriesSecond")
     */
    public function categoriesSecondLevel(Categories $categories,CategoriesRepository $categoriesRepository, Request $request, ContactsRepository $contactsRepository){
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];
        $id =  $categories->getId();
        $category = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isVisible = 1')
            ->where('c.parent = :par')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->setParameter('par', $id)
            ->getQuery()
            ->getResult();

        return $this->render('category/all.categories2.html.twig', [
            'categories' => $category,
            'contacts' => $contacts,
            'cat' => $categories
        ]);
    }
}
