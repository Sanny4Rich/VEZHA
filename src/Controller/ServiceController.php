<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\CategoriesRepository;
use App\Repository\ContactsRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service/{url}", defaults={"_locale" = "ua"}, name="service_nolocale")
     * @Route("/{_locale}/service/{url}", name="service")
     */
    public function index(Request $request, ContactsRepository $contactsRepository, Services $services, CategoriesRepository $categoriesRepository, ServicesRepository $servicesRepository)
    {
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language' => $locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language' => $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];

        $service = $servicesRepository->createQueryBuilder('s')
            ->addSelect('i')
            ->leftJoin('s.images', 'i')
            ->addSelect('t')
            ->leftJoin('s.serviceTranslations', 't')
            ->where('s = :service')
            ->setParameter('service', $services)
            ->getQuery()
            ->getResult();

        $service = $service[0];
        $categories = $categoriesRepository->createQueryBuilder('c')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();
        return $this->render('service/index.html.twig', [
            'categories' => $categories,
            'contacts' => $contacts,
            'service' => $service
        ]);
    }

    /**
     * @Route("/services", defaults={"_locale" = "ua"}, name="services_nolocale")
     * @Route("/{_locale}/services", name="services")
     */
    public function Services(Request $request,CategoriesRepository $categoriesRepository, ContactsRepository $contactsRepository, ServicesRepository $servicesRepository){
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language' => $locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language' => $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];

        $categories = $categoriesRepository->createQueryBuilder('c')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();

        $services = $servicesRepository->createQueryBuilder('s')
            ->where('s.isVisible = 1')
            ->addSelect('t')
            ->leftJoin('s.serviceTranslations', 't')
            ->getQuery()
            ->getResult();

        return $this->render('service/allservices.html.twig',
            ['categories' => $categories,
                'contacts' => $contacts,
                'services' => $services]
        );
    }
}
