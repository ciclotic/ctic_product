<?php
namespace CTIC\Product\Product\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use CTIC\Product\Product\Domain\Product;
use CTIC\Product\Product\Domain\ProductVariantComposed;
use CTIC\Product\Product\Domain\ProductVariantRate;

class ProductVariantCommand implements CommandInterface
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
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $textTPV;

    /**
     * @var string
     */
    public $sku;

    /**
     * @var string
     */
    public $order;

    /**
     * @var string
     */
    public $barCode;

    /**
     * @var float
     */
    public $minutes;

    /**
     * @var RealizationArea
     */
    public $realizationArea = null;

    /**
     * @var float
     */
    public $cost;

    /**
     * @var bool
     */
    public $stock;

    /**
     * @var bool
     */
    public $isComplement;

    /**
     * @var bool
     */
    public $hasComplement;

    /**
     * @var bool
     */
    public $enabled;

    /**
     * @var Product
     */
    public $product;

    /**
     * @var ProductVariantRate[]
     */
    public $productVariantRate;

    /**
     * @var ProductVariantComposed[]
     */
    public $productVariantComposed;
}