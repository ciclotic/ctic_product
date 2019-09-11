<?php

namespace CTIC\Product\Product\Infrastructure\Form\Type;

use CTIC\App\Company\Domain\Company;
use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use CTIC\App\PaymentMethod\Domain\PaymentMethodExpire;
use CTIC\App\Permission\Domain\PermissionInterface;
use CTIC\App\PaymentMethod\Domain\PaymentMethodInterface;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use CTIC\App\RealizationArea\Infrastructure\Repository\RealizationAreaRepository;
use CTIC\Device\Device\Domain\Device;
use CTIC\Device\Device\Infrastructure\Repository\DeviceRepository;
use CTIC\Product\Product\Domain\ProductDevice;
use CTIC\Product\Product\Domain\ProductVariant;
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

final class ProductVariantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /*
         *
    public function getProductVariantRate();
    public function setProductVariantRate($productVariantRate): bool;
    public function getProductVariantComposed();
    public function setProductVariantComposed($productVariantComposed): bool;
         */
        $builder
            ->setMethod('POST')
            ->add('id', HiddenType::class)
            ->add('name', TextType::class, [
                'label' => 'Nombre'
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug'
            ])
            ->add('textTPV', TextType::class, [
                'label' => 'Texto de la TPV'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Descripción'
            ])
            ->add('sku', TextType::class, [
                'label' => 'Referencia'
            ])
            ->add('order', TextType::class, [
                'label' => 'Orden'
            ])
            ->add('barCode', TextType::class, [
                'label' => 'Código de barras'
            ])
            ->add('minutes', TextType::class, [
                'label' => 'Minutos de realización'
            ])
            ->add('realizationArea',  EntityType::class, [
                'label' => 'Área de realización',
                'class' => RealizationArea::class,
                'query_builder' => function (RealizationAreaRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name'
            ])
            ->add('cost', TextType::class, [
                'label' => 'Coste'
            ])
            ->add('stock', ChoiceType::class, [
                'label'     => 'Stock habilitado',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                )
            ])
            ->add('isComplement', ChoiceType::class, [
                'label'     => 'Es complemento',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                )
            ])
            ->add('hasComplement', ChoiceType::class, [
                'label'     => 'Tiene complementos',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                )
            ])
            ->add('enabled', ChoiceType::class, [
                'label'     => 'Habilitado',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                )
            ])
            ->add('productVariantRate', CollectionType::class, [
                'label'                 => 'Tarifa de la variante de producto',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-success'
                ),
                'prototype_name'        => '__name-productVariantRate__',
                'entry_type'            => ProductVariantRateType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
            ->add('productVariantComposed', CollectionType::class, [
                'label'                 => 'Compuestos de variante de producto',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-success'
                ),
                'prototype_name'        => '__name-productVariantComposed__',
                'entry_type'            => ProductVariantComposedType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ProductVariant::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_product_productvariant';
    }
}
