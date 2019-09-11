<?php
namespace CTIC\Product\Product\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\Device\Device\Domain\Device;
use CTIC\Product\Product\Domain\Product;

class ProductDeviceCommand implements CommandInterface
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
     * @var Product
     */
    public $product;

    /**
     * @var Device
     */
    public $device;
}