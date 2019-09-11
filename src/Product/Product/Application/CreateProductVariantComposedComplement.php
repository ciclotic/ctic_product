<?php
namespace CTIC\Product\Product\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Product\Product\Domain\Command\ProductVariantComposedComplementCommand;
use CTIC\Product\Product\Domain\ProductVariant;
use CTIC\Product\Product\Domain\ProductVariantComposed;
use CTIC\Product\Product\Domain\ProductVariantComposedComplement;

class CreateProductVariantComposedComplement implements CreateInterface
{
    /**
     * @param CommandInterface|ProductVariantComposedComplementCommand $command
     * @return EntityInterface|ProductVariant
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $productVariantComposedComplement = new ProductVariantComposedComplement();
        $productVariantComposedComplement->setId($command->id);
        if (!empty($command->productVariant) && get_class($command->productVariant) == ProductVariant::class) {
            $productVariantComposedComplement->setProductVariant($command->productVariant);
        }
        if (!empty($command->productVariantComposed) && get_class($command->productVariantComposed) == ProductVariantComposed::class) {
            $productVariantComposedComplement->setProductVariantComposed($command->productVariantComposed);
        }

        return $productVariantComposedComplement;
    }
}