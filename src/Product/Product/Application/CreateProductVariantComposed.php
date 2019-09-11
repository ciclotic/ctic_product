<?php
namespace CTIC\Product\Product\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Product\Product\Domain\Command\ProductVariantComposedCommand;
use CTIC\Product\Product\Domain\ProductVariant;
use CTIC\Product\Product\Domain\ProductVariantComposed;
use Doctrine\Common\Collections\ArrayCollection;

class CreateProductVariantComposed implements CreateInterface
{
    /**
     * @param CommandInterface|ProductVariantComposedCommand $command
     * @return EntityInterface|ProductVariant
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $productVariantComposed = new ProductVariantComposed();
        $productVariantComposed->setId($command->id);
        $productVariantComposed->name = (empty($command->name))? '' : $command->name;
        if (!empty($command->productVariant) && get_class($command->productVariant) == ProductVariant::class) {
            $productVariantComposed->setProductVariant($command->productVariant);
        }
        if (!empty($command->productVariantComposedComplement) && get_class($command->productVariantComposedComplement) == ArrayCollection::class) {
            $productVariantComposed->setProductVariantComposedComplement($command->productVariantComposedComplement);
        }

        return $productVariantComposed;
    }
}