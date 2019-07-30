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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductsAdmin extends AbstractAdmin
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
            ->add('name')
            ->add('description', TextareaType::class, array('attr' => array('class' => 'ckeditor')))
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
            ->tab('Категории')
            ->add('primaryCategory')
            ->add('categories', ModelType::class, [

                'by_reference'          => false,
                'multiple'              => true,
                'expanded'              => true,     // or false
                'class'                 => Categories::class,
                'property'              => 'name',   // or any field in your media entity
                'label'                 => 'Категории',
                'btn_add'               => true,
                'btn_list'              => false,
                'btn_delete'            => true,
                'btn_catalogue'         => 'admin',   // or your own translate catalogue in my case file admin.en.yml
            ])
            ->end()
            ->end();
        $form
            ->tab('Главная страница')
            ->add('isOnHomePage', null, ['label' => 'Отображать на главной?'])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'image_uri' => function (Products $products, $resolverdUri) use ($cacheManager) {
                    // $cacheManager is LiipImagine cache Manager
                    if (!$resolverdUri) {
                        return null;
                    }
                    return $cacheManager->getBrowserPath($resolverdUri, 'squared_thumbnail');
                }
            ])
            ->end()
            ->end();

        $form
            ->tab('Новинка')
            ->add('isTop', null,
                ['label'=>'Отображать в меню новинки?'])
            ->add('imageFileTop', VichImageType::class, [
                'required' => false,
                'help' => 'Для коректного отображения загружать квадратные изображения',
                'image_uri' => function (Products $products, $resolverdUri) use ($cacheManager) {
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