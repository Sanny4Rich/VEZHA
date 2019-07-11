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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use function Symfony\Component\Validator\Tests\Constraints\choice_callback;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ContactAdmin extends AbstractAdmin
{

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('companyName')
            ->add('language');
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
            ->add('adress', TextareaType::class, ['attr' => ['class' => 'ckeditor'], 'label' => 'Адрес'])
            ->add('isPhoneShow', null, ['label' => 'Отображать номер телефона?'])
            ->add('phoneNumber', null, ['label' => 'Номер телефона', 'help' => 'Номер в формате "+380*********'])
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
            ->add('language', ChoiceType::class, [
                'label' => 'Для какого языка выводить',
                'choices' => [
                    'Українська' => 'ua',
                    'Русский' => 'ru',
                    'English' => 'en'
                ]
            ])
            ->end()
            ->end();

        $form
            ->tab('Социальные сети')
            ->add('isViberShow', null, ['label' => 'Отображать Viber?'])
            ->add('viber', null,['label'=> 'Viber', 'help' => 'Сылка не viber в виде: "viber://chat?number=+380*********" '])
            ->add('isTelegrammShow', null,['label' => 'Отображать Telegram?'])
            ->add('telegram', null, ['label' => 'Telegram', 'help'=> 'Ссылка на telegram в виде "tg://resolve?domain=nikname"'])
            ->add('isInstagramShow', null, ['label' => 'Отображать Instagram?'])
            ->add('instagram', null, ['label' => 'Instagram', 'help' => 'Ссылка на Instagram'])
            ->add('isFacebookShow', null, ['label' => 'Отобажать Facebook?'])
            ->add('facebook', null, ['label' => 'Facebook', 'help' => 'Ссылка на Facebook'])
            ->add('isTwitterShow', null, ['label' => 'Отображать Twitter?'])
            ->add('twitter', null, ['label'=> 'Twitter', 'help'=> 'Ссылка на Twitter']);
    }
}