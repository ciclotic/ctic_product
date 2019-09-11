<?php
namespace CTIC\Product\Product\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;
use CTIC\App\RealizationArea\Domain\RealizationArea;

interface ProductVariantInterface extends IdentifiableInterface, EntityInterface
{
    public function getName();
    public function getProduct();
    public function setProduct(Product $product);
    public function getDescription();
    public function getSlug();
    public function getTextTPV();
    public function getSku();
    public function getOrder();
    public function getBarCode();
    public function getMinutes();
    public function getRealizationArea();
    public function setRealizationArea(RealizationArea $realizationArea): bool;
    public function getCost();
    public function isStock();
    public function isComplement();
    public function isHasComplement();
    public function isEnabled();
    public function getProductVariantRate();
    public function setProductVariantRate($productVariantRate): bool;
    public function getProductVariantComposed();
    public function setProductVariantComposed($productVariantComposed): bool;
}