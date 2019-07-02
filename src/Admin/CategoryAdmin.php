<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CategoryAdmin extends AbstractAdmin
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
        //Основаня информация о категории
        $form
            ->tab('Основная информация')
            ->add('name')
            ->add('description')
            ->add('shortDescription')
            ->add('isVisible')
            ->add('isOnHomePage')
            ->end()
            ->end();
        $form
            ->tab('Главная страница')
            ->add('isOnHomePage')
            ->add('onHomePagePosition')
            ->end()
            ->end();
    }
}