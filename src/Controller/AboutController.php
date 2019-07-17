<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use App\Repository\AboutRepository;
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
    public function about(AboutRepository $aboutRepository,CategoriesRepository $categoriesRepository, Request $request, ContactsRepository $contactsRepository)
    {
        $locale = $request->get('_locale');
        $contacts = $contactsRepository->findBy(['language'=>$locale]);
        if ($contacts == [])
            $contacts = $contactsRepository->findBy(['language'=> $this->getParameter('kernel.default_locale')]);
        $contacts = $contacts[0];
        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->addSelect('t')
            ->leftJoin('c.categoriesTranslations', 't')
            ->getQuery()
            ->getResult();

        $about = $aboutRepository->createQueryBuilder('a')
            ->addSelect('p')
            ->leftJoin('a.partners', 'p')
            ->where('a.language =:lang')
            ->setParameter('lang', $locale)
            ->getQuery()
            ->getResult();
        if($about == []) {
            $about = $aboutRepository->createQueryBuilder('a')
                ->addSelect('p')
                ->leftJoin('a.partners', 'p')
                ->addSelect('k')
                ->leftJoin('a.partners', 'k')
                ->where('a.language =:lang')
                ->setParameter('lang', $this->getParameter('kernel.default_locale'))
                ->getQuery()
                ->getResult();
        }

        $about =$about[0];
        return $this->render('about/about.html.twig', [
            'categories' => $categories,
            'contacts' => $contacts,
            'about' => $about,
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
        $contacts = $contacts[0];
        $categories = $categoriesRepository->createQueryBuilder('c')
            ->where('c.isOnHomePage IS NOT NULL')
            ->getQuery()
            ->getResult();
        $feedback = new Feedback();
        $feedbackForm = $this->createForm(FeedbackType::class, $feedback);
        $feedbackForm->handleRequest($request);
        if ($feedbackForm->isSubmitted() && $feedbackForm->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($feedback);
            $manager->flush();
            return $this->redirect($request->getUri());}
        return $this->render('about/contact.html.twig', [
            'categories'=> $categories,
            'contacts' => $contacts,
             'form' => $feedbackForm->createView()
        ]);
    }
}
