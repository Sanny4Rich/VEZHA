<?php

namespace App\Admin;

use App\Entity\ProductImages;
use App\Entity\ServiceImages;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ServiceImagesAdmin extends AbstractAdmin
{
    /**
     * @var CacheManager
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
            ->addIdentifier('service');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('service');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $cacheManager = $this->cacheManager;
        $form
            ->add('title')
            ->add('description')
            ->add('language', ChoiceType::class, ['label' => 'Язык','choices'=> ['Українська'=> 'UA', 'Русский'=> 'RU','English'=>'en']])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'image_uri' => function (ServiceImages $images, $resolvedUri) use ($cacheManager) {
                    if (!$resolvedUri) {
                        return null;
                    }
                    return $cacheManager->getBrowserPath($resolvedUri, 'squared_thumbnail');
                }
            ]);
    }

}