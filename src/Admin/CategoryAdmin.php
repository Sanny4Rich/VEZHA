<?php

namespace App\Admin;

use Doctrine\Common\Cache\ChainCache;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->end()
            ->end();
        $form
            ->tab('Бокове меню')
            ->add('isOnHomePage', null, ['label' => 'Відображати?'])
            ->add('onHomePagePosition', ChoiceType::class, ['label' => 'Номер позиції', 'required'   => false, 'choices' => ['1'=> 1, '2'=> 2, '3'=> 3, '4'=> 4,'5'=>5, '6'=> 6, '7'=>7, '8'=>8, '9'=>9, '10'=>10, 'Не відображати' => 0]])
            ->end()
            ->end();
    }
}