<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ContactsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/{_locale}/about", name="about")
     */
    public function about(CategoriesRepository $categoriesRepository, Request $request, ContactsRepository $contactsRepository)
    {
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        return $this->render('about/about.html.twig', [
            'categories' => $categories,
            'contacts' => $contacts
        ]);
    }

    /**
     * @Route("/{_locale}/contacts", name="contacts")
     */
    public function contacts(CategoriesRepository $categoriesRepository, Request $request, ContactsRepository $contactsRepository){
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        return $this->render('about/contact.html.twig', [
            'categories'=> $categories,
            'contacts' => $contacts
        ]);
    }
}
