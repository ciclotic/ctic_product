<?php
namespace CTIC\Product\Product\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Company\Domain\Company;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\User\Domain\User;
use CTIC\Product\Attribute\Domain\Attribute;
use CTIC\Product\Option\Domain\Option;
use CTIC\Product\Product\Domain\ProductDevice;
use CTIC\Product\Product\Domain\ProductObservation;
use CTIC\Product\Product\Domain\ProductVariant;

class ProductCommand implements CommandInterface
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
     * @var bool
     */
    public $isService;

    /**
     * @var bool
     */
    public $enabledDiscountClient;

    /**
     * @var bool
     */
    public $enabled;

    /**
     * @var User
     */
    public $user = null;

    /**
     * @var Iva
     */
    public $iva = null;

    /**
     * @var Company
     */
    public $company = null;

    /**
     * @var ProductDevice[]
     */
    public $productDevice;

    /**
     * @var ProductObservation[]
     */
    public $productObservation;

    /**
     * @var Option[]
     */
    public $option;

    /**
     * @var Attribute[]
     */
    public $attribute;

    /**
     * @var ProductVariant[]
     */
    public $productVariant;
}