<?php
namespace CTIC\Product\Product\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Rate\Domain\Rate;
use CTIC\Product\Product\Domain\ProductVariant;
use CTIC\Product\Product\Domain\ProductVariantComposed;

class ProductVariantComposedComplementCommand implements CommandInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var ProductVariant
     */
    public $productVariant;

    /**
     * @var ProductVariantComposed
     */
    public $productVariantComposed;
}