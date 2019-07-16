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
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommentsAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->add('language')
            ->add('isShow', null, ['label'=> 'Отображать?']);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('language')
            ->add('isShow');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name', null, ['label' => 'Имя Коментатора'])
            ->add('text',TextareaType::class, array('attr' => array('class' => 'ckeditor'), 'required' => false))
            ->add('product', null, ['label' => 'Товар/Услуга текстом'])
            ->add('language', ChoiceType::class, ['label'=>'Язык на котором будет отображаться','choices'=>['Українська' => 'ua', 'Русский'=> 'ru', 'English' => 'en'] ])
            ->add('isShow')
            ->end();
    }
}