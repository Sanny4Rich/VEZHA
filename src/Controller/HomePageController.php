<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Products;
use App\Entity\Services;
use App\Repository\CategoriesRepository;
use App\Repository\CommentsRepository;
use App\Repository\ContactsRepository;
use App\Repository\ProductsRepository;
use App\Repository\ServicesRepository;
use Entity\Repository\CategoryRepository;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
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
     * @Route("/{_locale}/", name="home_page", defaults={"_locale" = "ua"}, requirements={"_locale" = "ua|ru|en" })
     */
    public function index(Request $request,ContactsRepository $contactsRepository, ProductsRepository $productsRepository, ServicesRepository $servicesRepository, CategoriesRepository $categoriesRepository, CommentsRepository $commentsRepository)
    {

        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
            if ($contacts == [])
                $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];
        $services = $servicesRepository->createQueryBuilder('s')
            ->addSelect('t')
            ->leftJoin('s.serviceTranslations', 't')
            ->where('s.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();

        $products = $productsRepository->createQueryBuilder('s')
            ->where('s.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();

        $comments = $commentsRepository->findAll();

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'products' => $products,
            'services' => $services,
            'categories' => $categories,
            'contacts' => $contacts,
            'comments' => $comments
        ]);
    }

}
