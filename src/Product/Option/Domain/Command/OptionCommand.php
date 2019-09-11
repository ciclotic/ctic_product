<?php
namespace CTIC\Product\Option\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Company\Domain\Company;
use CTIC\Product\Option\Domain\Option;

class OptionCommand implements CommandInterface
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
    public $order;

    /**
     * @var bool
     */
    public $enabled;

    /**
     * @var Option
     */
    public $parent = null;

    /**
     * @var Company
     */
    public $company = null;
}