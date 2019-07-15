<?php

namespace App\Admin;


use App\Entity\About;
use App\Entity\Categories;
use App\Entity\Products;
use App\Entity\Services;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AboutAdmin extends AbstractAdmin
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
            ->addIdentifier('aboutTitle')
            ->add('language');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('aboutTitle');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $cacheManager = $this->cacheManager;
        //Основаня информация о технике
        $form
            ->tab('О нас')
            ->add('aboutTitle')
            ->add('aboutDescription', TextareaType::class, array('attr' => array('class' => 'ckeditor'), 'required' => false))
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'image_uri' => function (About $about, $resolverdUri) use ($cacheManager) {
                    // $cacheManager is LiipImagine cache Manager
                    if (!$resolverdUri) {
                        return null;
                    }
                    return $cacheManager->getBrowserPath($resolverdUri, 'squared_thumbnail');
                }
            ])
            ->add('language', ChoiceType::class, ['label'=>'Язык' , 'choices'=> ['Українська'=>'ua', 'Русский'=> 'ru', 'English' => 'en']])
            ->end()
            ->end();

            $form
                ->tab('Основные направления')
                ->with('Первая колонка', ['class'=>'col-4', 'box_class'   => 'box box-solid box-dange'])
                ->add('firstOurDirectionTitle')
                ->add('firstOurDirectionDescription')
                ->end()
                ->with('Вторая колонка', ['class'=>'col-4', 'box_class'   => 'box box-solid box-dange'])
                ->add('secondOurDirectionTitle')
                ->add('secondOurDirectionDescription')
                ->end()
                ->with('Третья колонка', ['class'=>'col-4', 'box_class'   => 'box box-solid box-dange'])
                ->add('thirdOurDirectionTitle')
                ->add('thirdOurDirectionDescription')
                ->end()
                ->end();
    }
}