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
use CTIC\Product\Product\Domain\ProductVariant;
use CTIC\Product\Product\Domain\ProductVariantComposed;
use CTIC\Product\Product\Domain\ProductVariantComposedComplement;
use CTIC\Product\Product\Domain\ProductVariantRate;
use CTIC\Product\Product\Infrastructure\Repository\ProductVariantRepository;
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

final class ProductVariantComposedComplementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('POST')
            ->add('id', HiddenType::class)
            ->add('productVariant',  EntityType::class, [
                'label' => 'Variante de producto asociada',
                'class' => ProductVariant::class,
                'query_builder' => function (ProductVariantRepository $er) {
                    return $er
                        ->createQueryBuilder('a')
                        ->where('a.isComplement = true');
                },
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ProductVariantComposedComplement::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_product_productvariantcomposedcomplement';
    }
}
