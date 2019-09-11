<?php
namespace CTIC\Product\Product\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface ProductVariantComposedInterface extends IdentifiableInterface, EntityInterface
{
    public function getName();
    public function getProductVariant();
    public function setProductVariant(ProductVariant $productVariant): bool;
    public function getProductVariantComposedComplement();
    public function setProductVariantComposedComplement($productVariantComposedComplement): bool;
}