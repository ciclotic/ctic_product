<?php

namespace CTIC\Product\Attribute\Infrastructure\Form\Type;

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
use CTIC\Product\Attribute\Domain\AttributeInterface;
use CTIC\Product\Attribute\Infrastructure\Repository\AttributeRepository;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class AttributeType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $attributes): void
    {
        $builder
            ->setMethod('POST')
            ->add('name', TextType::class, [
                'label' => 'Nombre',
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
            ])
            ->add('textTPV', TextType::class, [
                'label' => 'Texto de la TPV',
            ])
            ->add('type', ChoiceType::class, [
                'label'     => 'Tipo',
                'choices'   => array(
                    'Generica'          => AttributeInterface::TYPE_GENERIC,
                    'Números'           => AttributeInterface::TYPE_INT,
                    'Decimales'         => AttributeInterface::TYPE_FLOAT,
                    'Texto'             => AttributeInterface::TYPE_TEXT,
                    'Booleano'          => AttributeInterface::TYPE_BOOL,
                    'Fecha'             => AttributeInterface::TYPE_DATE,
                    'Hora'              => AttributeInterface::TYPE_TIME,
                    'Fecha y hora'      => AttributeInterface::TYPE_DATETIME,
                )
            ])
            ->add('order', TextType::class, [
                'label' => 'Orden',
            ])
            ->add('enabled', ChoiceType::class, [
                'label'     => 'Habilitado',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                )
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
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_product_attribute';
    }
}
