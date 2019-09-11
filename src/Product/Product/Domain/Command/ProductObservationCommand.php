<?php
namespace CTIC\Product\Product\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\Device\Device\Domain\Device;
use CTIC\Product\Product\Domain\Product;

class ProductObservationCommand implements CommandInterface
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
    public $observation;

    /**
     * @var Product
     */
    public $product;
}