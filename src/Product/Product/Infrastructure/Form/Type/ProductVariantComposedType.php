<?php

namespace CTIC\Product\Product\Infrastructure\Form\Type;

use CTIC\App\Company\Domain\Company;
use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use CTIC\App\PaymentMethod\Domain\PaymentMethodExpire;
use CTIC\App\Permission\Domain\PermissionInterface;
use CTIC\App\PaymentMethod\Domain\PaymentMethodInterface;
use CTIC\App\Rate\Domain\Rate;
use CTIC\App\Rate\Infrastructure\Repository\RateRepository;
use CTIC\Device\Device\Domain\Device;
use CTIC\Device\Device\Infrastructure\Repository\DeviceRepository;
use CTIC\Product\Product\Domain\ProductDevice;
use CTIC\Product\Product\Domain\ProductVariantComposed;
use CTIC\Product\Product\Domain\ProductVariantComposedComplement;
use CTIC\Product\Product\Domain\ProductVariantRate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductVariantComposedType extends AbstractType
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
            ->add('productVariantComposedComplement', CollectionType::class, [
                'label'                 => 'Complementos',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-black'
                ),
                'prototype_name'        => '__name-productVariantComposedComplement__',
                'entry_type'            => ProductVariantComposedComplementType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ProductVariantComposed::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_product_productvariantcomposed';
    }
}
