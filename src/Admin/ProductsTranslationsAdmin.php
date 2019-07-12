<?php

namespace App\Admin;


use App\Entity\Categories;
use App\Entity\Services;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use function Sodium\add;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsTranslationsAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->add('product')
            ->add('language');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('product')
            ->add('language');
    }

    protected function configureFormFields(FormMapper $form)
    {
        //Основаня информация о технике
        $form
            ->add('name')
            ->add('product')
            ->add('description', TextareaType::class, array('attr' => array('class' => 'ckeditor'), 'required' => false))
            ->add('shortDescription')
            ->add('language', ChoiceType::class, ['choices' => ['Українська' => 'ua', 'Русский' => 'ru', 'English' => 'en']]);
    }
}