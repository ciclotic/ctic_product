<?php
namespace CTIC\Product\Product\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Rate\Domain\Rate;
use CTIC\Product\Product\Domain\Command\ProductVariantRateCommand;
use CTIC\Product\Product\Domain\ProductVariant;
use CTIC\Product\Product\Domain\ProductVariantRate;

class CreateProductVariantRate implements CreateInterface
{
    /**
     * @param CommandInterface|ProductVariantRateCommand $command
     * @return EntityInterface|ProductVariant
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $productVariantRate = new ProductVariantRate();
        $productVariantRate->setId($command->id);
        $productVariantRate->pvp = (empty($command->pvp))? 0 : $command->pvp;
        $productVariantRate->commission = (empty($command->commission))? 0 : $command->commission;
        if (!empty($command->rate) && get_class($command->rate) == Rate::class) {
            $productVariantRate->setRate($command->rate);
        }
        if (!empty($command->productVariant) && get_class($command->productVariant) == ProductVariant::class) {
            $productVariantRate->setProductVariant($command->productVariant);
        }

        return $productVariantRate;
    }
}