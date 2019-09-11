<?php

namespace CTIC\Product\Product\Infrastructure\Form\Type;

use CTIC\App\Base\Infrastructure\Repository\EntityRepository;
use CTIC\App\Company\Domain\Company;
use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Base\Infrastructure\Form\Type\AbstractResourceType;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\Iva\Infrastructure\Repository\IvaRepository;
use CTIC\App\Permission\Domain\PermissionInterface;
use CTIC\App\User\Domain\User;
use CTIC\App\User\Infrastructure\Repository\UserRepository;
use CTIC\Product\Attribute\Domain\Attribute;
use CTIC\Product\Option\Domain\Option;
use CTIC\Product\Product\Domain\ProductInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('POST')
            ->add('name', TextType::class, [
                'label' => 'Nombre',
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Descripción',
            ])
            ->add('textTPV', TextType::class, [
                'label' => 'Texto de la TPV',
            ])
            ->add('sku', TextType::class, [
                'label' => 'Referencia',
            ])
            ->add('order', TextType::class, [
                'label' => 'Orden',
            ])
            ->add('barCode', TextType::class, [
                'label' => 'Código de barras',
            ])
            ->add('isService', ChoiceType::class, [
                'label'     => 'Es un servicio',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                )
            ])
            ->add('enabledDiscountClient', ChoiceType::class, [
                'label'     => 'Descuento de cliente habilitado',
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
            ->add('iva',  EntityType::class, [
                'label' => 'Iva',
                'class' => Iva::class,
                'query_builder' => function (IvaRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name'
            ])
            ->add('user',  EntityType::class, [
                'label' => 'Usuario asociado',
                'class' => User::class,
                'query_builder' => function (UserRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name'
            ])
            ->add('productDevice', CollectionType::class, [
                'label'                 => 'Dispositivos',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-primary'
                ),
                'prototype_name'        => '__name-productDevice__',
                'entry_type'            => ProductDeviceType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
            ->add('productObservation', CollectionType::class, [
                'label'                 => 'Observaciones',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-primary'
                ),
                'prototype_name'        => '__name-productObservation__',
                'entry_type'            => ProductObservationType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
            ->add('option', EntityType::class, [
                'label'         => 'Opciones (Multiselección)',
                'class'         => Option::class,
                'required'      => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ec')
                        ->orderBy('ec.name', 'ASC');
                },
                'expanded'      => false,
                'multiple'      => true,
                'choice_label' => 'name'
            ])
            ->add('attribute', EntityType::class, [
                'label'         => 'Atributos (Multiselección)',
                'class'         => Attribute::class,
                'required'      => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ec')
                        ->orderBy('ec.name', 'ASC');
                },
                'expanded'      => false,
                'multiple'      => true,
                'choice_label' => 'name'
            ])
            ->add('company',  EntityType::class, [
                'label' => 'Empresa',
                'class' => Company::class,
                'query_builder' => function (CompanyRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'taxName'
            ])
            ->add('productVariant', CollectionType::class, [
                'label'                 => 'Variantes de producto',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-primary'
                ),
                'prototype_name'        => '__name-productVariant__',
                'entry_type'            => ProductVariantType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_product_product';
    }
}
