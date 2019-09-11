<?php
namespace CTIC\Product\Product\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;
use CTIC\Device\Device\Domain\Device;

interface ProductDeviceInterface extends IdentifiableInterface, EntityInterface
{
    public function getName();
    public function getProduct();
    public function setProduct(Product $device): bool;
    public function getDevice();
    public function setDevice(Device $device): bool;
}