<?php
namespace CTIC\Product\Product\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface ProductVariantComposedComplementInterface extends IdentifiableInterface, EntityInterface
{
    public function getProductVariant();
    public function setProductVariant(ProductVariant $productVariant): bool;
    public function getProductVariantComposed();
    public function setProductVariantComposed(ProductVariantComposed $productVariant): bool;
}