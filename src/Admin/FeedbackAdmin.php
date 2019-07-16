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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FeedbackAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->add('isAnswered');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('isAnswered');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name', TextType::class, ['label'=> 'Имя', 'attr' => ['readonly'=>true]])
            ->add('phoneNumber', TextType::class, ['label'=> 'Номер телефона','attr' => ['readonly'=>true]])
            ->add('email', TextType::class, ['label'=> 'Электронная почта','attr' => ['readonly'=>true]])
            ->add('message', TextType::class, ['label' => 'Сообщение','attr' => ['readonly'=>true]])
            ->add('isAnswered');
    }
}