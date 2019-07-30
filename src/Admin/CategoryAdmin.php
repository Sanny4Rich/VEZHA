<?php

namespace App\Admin;

use App\Entity\Categories;
use Doctrine\Common\Cache\ChainCache;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CategoryAdmin extends AbstractAdmin
{
    /**
     * @var CacheManager
     *
     */
    private $cacheManager;

    public function __construct(string $code, string $class, string $baseControllerName, CacheManager $cacheManager)

    {
        parent::__construct($code, $class, $baseControllerName);

        $this->cacheManager = $cacheManager;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->addIdentifier('parent')
            ->addIdentifier('isVisible')
            ->addIdentifier('isOnHomePage');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('parent')
            ->add('isVisible')
            ->add('isOnHomePage', null, ['label' => 'Отображается в боковом меню']);
    }

    protected function configureFormFields(FormMapper $form)
    {
        $cacheManager = $this->cacheManager;
        //Основаня информация о категории
        $form
            ->tab('Основная информация')
            ->add('name')
            ->add('parent')
            ->add('description', TextareaType::class, array('attr' => array('class' => 'ckeditor'), 'required' => false))
            ->add('shortDescription')
            ->add('isVisible')
            ->end()
            ->end();
        $form
            ->tab('Бокове меню')
            ->add('isOnHomePage', null, ['label' => 'Відображати?'])
//            ->add('onHomePagePosition', ChoiceType::class, ['label' => 'Номер позиції', 'required'   => false, 'choices' => ['1'=> 1, '2'=> 2, '3'=> 3, '4'=> 4,'5'=>5, '6'=> 6, '7'=>7, '8'=>8, '9'=>9, '10'=>10, 'Не відображати' => 0]])
            ->end()
            ->end();

        $form
            ->tab('Картинка')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'help' => 'Размер картинки 370*370',
                'image_uri' => function (Categories $categories, $resolverdUri) use ($cacheManager) {
                    // $cacheManager is LiipImagine cache Manager
                    if (!$resolverdUri) {
                        return null;
                    }
                    return $cacheManager->getBrowserPath($resolverdUri, 'squared_thumbnail');
                }
            ])
            ->end()
            ->end();
    }
}