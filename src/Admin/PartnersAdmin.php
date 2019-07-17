<?php

namespace App\Admin;

use App\Entity\Categories;
use App\Entity\Partners;
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

class PartnersAdmin extends AbstractAdmin
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
            ->add('isVisible', null, ['label' => 'Видимый'])
            ->add('isOnHomePage', null, ['label' => 'Отображается на главной']);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('isVisible', null, ['label'=>'Видимый'])
            ->add('isOnHomePage', null, ['label'=>'На главной']);
    }

    protected function configureFormFields(FormMapper $form)
    {
        $cacheManager = $this->cacheManager;
        //Основаня информация о категории
        $form
            ->tab('Основная информация')
            ->add('name',null, ['label' => 'Название'])
            ->add('description', TextareaType::class, array('label'=>'Текст описание','attr' => array('class' => 'ckeditor'), 'required' => false))
            ->add('shortDescription', null, ['label' => 'Заголовок'])
            ->add('isVisible')
            ->end()
            ->end();
        $form
            ->tab('Главная страница')
            ->add('isOnHomePage', null, ['label' => 'Отображать?'])
            ->add('onHomePagePosition', ChoiceType::class, ['label' => 'Номер позиции', 'required'   => false, 'choices' => ['1'=> 1, '2'=> 2, '3'=> 3, '4'=> 4,'5'=>5, '6'=> 6, '7'=>7, '8'=>8, '9'=>9, '10'=>10,'11'=>11,'12'=>12,'13'=>13,'14'=>14,'15'=>15,'16'=>16,'17'=>17,'18'=>18,'19'=>19,'20'=>20, 'Не відображати' => 0]])
            ->add('imageLogoFile', VichImageType::class, [
                'required' => false,
                'image_uri' => function (Partners $partners, $resolverdUri) use ($cacheManager) {
                    // $cacheManager is LiipImagine cache Manager
                    if (!$resolverdUri) {
                        return null;
                    }
                    return $cacheManager->getBrowserPath($resolverdUri, 'news_thumbnail');
                }
            ])
            ->end()
            ->end();

        $form
            ->tab('Картинка на странице партнера')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'image_uri' => function (Partners $partners, $resolverdUri) use ($cacheManager) {
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