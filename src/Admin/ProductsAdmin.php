<?php

namespace App\Admin;


use App\Entity\Categories;
use App\Entity\Services;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsAdmin extends AbstractAdmin
{
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
        //Основаня информация о технике
        $form
            ->tab('Основаня информация')
            ->add('name')
            ->add('description')
            ->add('isOnHomePage')
            ->add('isVisible')
            ->add('isTop')
            ->end()
            ->end();
        //Услуги
        $form
            ->tab('Картиник')
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


    }
}