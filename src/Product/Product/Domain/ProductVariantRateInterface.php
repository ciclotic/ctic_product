<?php
namespace CTIC\Product\Product\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;
use CTIC\App\Rate\Domain\Rate;

interface ProductVariantRateInterface extends IdentifiableInterface, EntityInterface
{
    public function getPvp();
    public function getCommission();
    public function getRate();
    public function setRate(Rate $rate): bool;
    public function getProductVariant();
    public function setProductVariant(ProductVariant $productVariant): bool;
}