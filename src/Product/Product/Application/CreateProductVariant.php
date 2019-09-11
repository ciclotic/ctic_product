<?php
namespace CTIC\Product\Product\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use CTIC\Product\Product\Domain\Command\ProductVariantCommand;
use CTIC\Product\Product\Domain\Product;
use CTIC\Product\Product\Domain\ProductVariant;
use Doctrine\Common\Collections\ArrayCollection;

class CreateProductVariant implements CreateInterface
{
    /**
     * @param CommandInterface|ProductVariantCommand $command
     * @return EntityInterface|ProductVariant
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $productVariant = new ProductVariant();
        $productVariant->setId($command->id);
        $productVariant->name = (empty($command->name))? '' : $command->name;
        $productVariant->slug = (empty($command->slug))? '' : $command->slug;
        $productVariant->description = (empty($command->description))? '' : $command->description;
        $productVariant->textTPV = (empty($command->textTPV))? '' : $command->textTPV;
        $productVariant->sku = (empty($command->sku))? '' : $command->sku;
        $productVariant->order = (empty($command->order))? '' : $command->order;
        $productVariant->barCode = (empty($command->barCode))? '' : $command->barCode;
        $productVariant->minutes = (empty($command->minutes))? '' : $command->minutes;
        $productVariant->cost = (empty($command->cost))? 0 : $command->cost;
        $productVariant->stock = (empty($command->stock))? '' : $command->stock;
        $productVariant->isComplement = (empty($command->isComplement))? '' : $command->isComplement;
        $productVariant->enabled = (empty($command->enabled))? '' : $command->enabled;
        if (!empty($command->product) && get_class($command->product) == Product::class) {
            $productVariant->setProduct($command->product);
        }
        if (!empty($command->realizationArea) && get_class($command->realizationArea) == RealizationArea::class) {
            $productVariant->setRealizationArea($command->realizationArea);
        }
        if (!empty($command->productVariantRate) && get_class($command->productVariantRate) == ArrayCollection::class) {
            $productVariant->setProductVariantRate($command->productVariantRate);
        }
        if (!empty($command->productVariantComposed) && get_class($command->productVariantComposed) == ArrayCollection::class) {
            $productVariant->setProductVariantComposed($command->productVariantComposed);
        }

        return $productVariant;
    }
}