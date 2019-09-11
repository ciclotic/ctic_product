<?php
namespace CTIC\Product\Product\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Rate\Domain\Rate;
use CTIC\Product\Product\Domain\ProductVariant;

class ProductVariantRateCommand implements CommandInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var float
     */
    public $pvp;

    /**
     * @var float
     */
    public $commission;

    /**
     * @var Rate
     */
    public $rate;

    /**
     * @var ProductVariant
     */
    public $productVariant;
}