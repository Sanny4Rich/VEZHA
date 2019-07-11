<?php

namespace App\Admin;

use App\Entity\Categories;
use Doctrine\Common\Cache\ChainCache;
use function Sodium\add;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use function Symfony\Component\Validator\Tests\Constraints\choice_callback;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ContactAdmin extends AbstractAdmin
{

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('companyName');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('companyName');
    }

    protected function configureFormFields(FormMapper $form)
    {

        $form
            ->tab('Основная информация')
            ->add('companyName')
            ->add('isAddressShow', null, ['label'=> 'Отображать адрес?'])
            ->add('adress', null,['label' => 'Адрес'])
            ->add('isPhoneShow', null, ['label' => 'Отображать номер телефона?'])
            ->add('phoneNumber', null, ['label' => 'Номер телефона'])
            ->add('isEmailShow', null, ['label' => 'Отображать email?'])
            ->add('email', null,['label'=> 'Email'])
            ->add('workStart', null, [
                'label'=> 'Время открытия :',
                'help' => 'Время вводить в формате 00:00'
            ])
            ->add('workEnd', null, [
                'label'=> 'Время закрыти :',
                'help' => 'Время вводить в формате 00:00'
            ])
            ->end()
            ->end();

    }
}