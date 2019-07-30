<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\CommentsRepository;
use App\Repository\ContactsRepository;
use App\Repository\PartnersRepository;
use App\Repository\ProductsRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{

    /**
     * @Route("/",defaults={"_locale"="ua"}, name="home_page_nolocale")
     * @Route("/{_locale}/", name="home_page", defaults={"_locale"="ua"}, requirements={"_locale"="ua|ru|en" })
     */
    public function index(Request $request,ContactsRepository $contactsRepository,
                          ProductsRepository $productsRepository,
                          ServicesRepository $servicesRepository,
                          CategoriesRepository $categoriesRepository,
                          CommentsRepository $commentsRepository, PartnersRepository $partnersRepository)
    {

        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
            if ($contacts == []){
                $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
            }
        $contacts = $contacts[0];
        $services = $servicesRepository->createQueryBuilder('s')
            ->addSelect('t')
            ->leftJoin('s.serviceTranslations', 't')
            ->where('s.isOnHomePage = 1')
            ->getQuery()
            ->getResult();

        $products = $productsRepository->createQueryBuilder('s')
            ->where('s.isOnHomePage = 1')
            ->getQuery()
            ->getResult();

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();

        $comments = $commentsRepository->findAll();

        $partners = $partnersRepository->createQueryBuilder('p')
            ->addSelect('t')
            ->leftJoin('p.partnersTranslations', 't')
            ->getQuery()
            ->getResult();

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'products' => $products,
            'services' => $services,
            'categories' => $categories,
            'contacts' => $contacts,
            'comments' => $comments,
            'partners' => $partners,
        ]);
    }

}
