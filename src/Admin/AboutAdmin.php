<?php

namespace App\Admin;


use App\Entity\About;
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

class AboutAdmin extends AbstractAdmin
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
            ->addIdentifier('aboutTitle');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('aboutTitle');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $cacheManager = $this->cacheManager;
        //Основаня информация о технике
        $form
            ->tab('О нас')
            ->add('aboutTitle')
            ->add('aboutDescription')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'image_uri' => function (About $about, $resolverdUri) use ($cacheManager) {
                    // $cacheManager is LiipImagine cache Manager
                    if (!$resolverdUri) {
                        return null;
                    }
                    return $cacheManager->getBrowserPath($resolverdUri, 'squared_thumbnail');
                }
            ]);
    }
}