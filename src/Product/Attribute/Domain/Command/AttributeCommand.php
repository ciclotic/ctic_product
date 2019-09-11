<?php
namespace CTIC\Product\Attribute\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Company\Domain\Company;
use CTIC\Product\Attribute\Domain\Attribute;

class AttributeCommand implements CommandInterface
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
    public $textTPV;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $order;

    /**
     * @var bool
     */
    public $enabled;

    /**
     * @var Company
     */
    public $company = null;
}