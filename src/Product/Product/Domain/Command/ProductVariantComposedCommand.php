<?php
namespace CTIC\Product\Product\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Rate\Domain\Rate;
use CTIC\Product\Product\Domain\ProductVariant;
use CTIC\Product\Product\Domain\ProductVariantComposedComplement;

class ProductVariantComposedCommand implements CommandInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var ProductVariant
     */
    public $productVariant;

    /**
     * @var ProductVariantComposedComplement[]
     */
    public $productVariantComposedComplement;
}