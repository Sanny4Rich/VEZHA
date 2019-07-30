<?php

namespace App\Controller;

use App\Entity\HomePage;
use App\Entity\Partners;
use App\Repository\CategoriesRepository;
use App\Repository\ContactsRepository;
use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PartnerController extends AbstractController
{
    /**
     * @Route("/partner/{url}", defaults={"_locale" = "ua"})
     * @Route("/{_locale}/partner/{url}", name="partner")
     */
    public function index(Request $request, ContactsRepository $contactsRepository,Partners $partners, CategoriesRepository $categoriesRepository, PartnersRepository $partnersRepository )
    {
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage = 1')
             ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();

        $partner = $partnersRepository->createQueryBuilder('p')
            ->where('p = :partners')
            ->addSelect('t')
            ->leftJoin('p.partnersTranslations', 't')
            ->setParameter('partners', $partners)
            ->getQuery()
            ->getResult();

        $partner = $partner[0];
        return $this->render('partner/index.html.twig', [
            'categories' => $categories,
            'contacts' => $contacts,
            'partner' => $partner,
        ]);
    }
}
