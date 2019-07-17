<?php

namespace App\Admin;


use App\Entity\Categories;
use App\Entity\Products;
use App\Entity\Services;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ServiceAdmin extends AbstractAdmin
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
        $cacheManager = $this->cacheManager;
        //Основаня информация о технике
        $form
            ->tab('Основаня информация')
            ->add('name', null, ['label' => 'Название'])
            ->add('description', TextareaType::class, array('label'=> 'Описание','attr' => array('class' => 'ckeditor')))
            ->add('isVisible', null, ['label'=> 'Отображать?'])
            ->end()
            ->end();
        //Услуги
        $form
            ->tab('Картинки')
            ->add('images',
                CollectionType::class,
                ['by_reference' => false],
                    [
                        'edit' => 'inline',
                        'inline' => 'table'
                    ]
                )
            ->end()
            ->end();
        $form
            ->tab('Главная страница')
            ->add('isOnHomePage', null, ['label' => 'Отображать на главной?'])
            ->add('onHomePagePosition', ChoiceType::class, ['label' => 'Номер позиції', 'required'   => false, 'choices' => ['1'=> 1, '2'=> 2, '3'=> 3, '4'=> 4,'5'=>5, '6'=> 6, '7'=>7, '8'=>8, '9'=>9, '10'=>10, 'Не відображати' => 0]])
            ->end()
            ->end();

        $form
            ->tab('Картинка для карточки')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'help' => 'Для коректного отображения загружать квадратные изображения больше чем 360Х360',
                'image_uri' => function (Services $services, $resolverdUri) use ($cacheManager) {
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