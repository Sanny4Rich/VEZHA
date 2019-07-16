<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\CategoriesRepository;
use App\Repository\ContactsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/{_locale}/service/{url}", name="service")
     */
    public function index(Request $request, ContactsRepository $contactsRepository, Services $services, CategoriesRepository $categoriesRepository)
    {
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        return $this->render('service/index.html.twig', [
            'categories' => $categories,
            'contacts' => $contacts
        ]);
    }
}
