<?php

namespace CTIC\Product\Product\Infrastructure\Form\Type;

use CTIC\App\Company\Domain\Company;
use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use CTIC\App\PaymentMethod\Domain\PaymentMethodExpire;
use CTIC\App\Permission\Domain\PermissionInterface;
use CTIC\App\PaymentMethod\Domain\PaymentMethodInterface;
use CTIC\Device\Device\Domain\Device;
use CTIC\Device\Device\Infrastructure\Repository\DeviceRepository;
use CTIC\Product\Product\Domain\ProductDevice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductDeviceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('POST')
            ->add('id', HiddenType::class)
            ->add('name', TextType::class, [
                'label' => 'Nombre'
            ])
            ->add('device',  EntityType::class, [
                'label' => 'Dispositivo asociado',
                'class' => Device::class,
                'query_builder' => function (DeviceRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ProductDevice::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_product_productdevice';
    }
}
