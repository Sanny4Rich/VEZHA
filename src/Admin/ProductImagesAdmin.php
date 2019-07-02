<?php

namespace App\Admin;

use App\Entity\ProductImages;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductImagesAdmin extends AbstractAdmin
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
            ->addIdentifier('product');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('product');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $cacheManager = $this->cacheManager;
        $form
            ->add('product')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'image_uri' => function (ProductImages $images, $resolvedUri) use ($cacheManager) {
                    if (!$resolvedUri) {
                        return null;
                    }
                    return $cacheManager->getBrowserPath($resolvedUri, 'squared_thumbnail');
                }
            ]);
    }

}