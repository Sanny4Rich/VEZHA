<?php

namespace App\Admin;

use App\Entity\Services;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ServicesAdmin extends AbstractAdmin
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
            ->addIdentifier('name');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name');
    }

    protected function configureFormFields(FormMapper $form)
    {

        //Основаня информация о категории
        $form
            ->tab('Основная информация')
            ->add('name')
            ->add('description', TextareaType::class, array('attr' => array('class' => 'ckeditor')))
            ->add('shortDescription', null, ['label' => 'Короткое описание'])
            ->add('isVisible', null, ['label'=> 'Видимый?'])
            ->end()
            ->end();
        $form
            ->tab('Главная страница')
            ->add('isOnHomePage')
            ->add('onHomePagePosition', null, ['label' => 'Позиция на главной странице', 'help' => 'Цифра больше 0 '])
//            ->add('imageFile', VichImageType::class, [
//                'required' => false,
//                'image_uri' => function (Services $services, $resolverdUri) use ($cacheManager) {
//                    // $cacheManager is LiipImagine cache Manager
//                    if (!$resolverdUri) {
//                        return null;
//                    }
//                    return $cacheManager->getBrowserPath($resolverdUri, 'squared_thumbnail');
//                }
//            ])
            ->end()
            ->end();
    }
}