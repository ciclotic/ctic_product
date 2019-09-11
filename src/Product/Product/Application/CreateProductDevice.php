<?php
namespace CTIC\Product\Product\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Device\Device\Domain\Device;
use CTIC\Product\Product\Domain\Command\ProductDeviceCommand;
use CTIC\Product\Product\Domain\Product;
use CTIC\Product\Product\Domain\ProductDevice;

class CreateProductDevice implements CreateInterface
{
    /**
     * @param CommandInterface|ProductDeviceCommand $command
     * @return EntityInterface|ProductDevice
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $productDevice = new ProductDevice();
        $productDevice->setId($command->id);
        $productDevice->name = (empty($command->name))? '' : $command->name;
        if (!empty($command->device) && get_class($command->device) == Device::class) {
            $productDevice->setDevice($command->device);
        }
        if (!empty($command->product) && get_class($command->product) == Product::class) {
            $productDevice->setProduct($command->product);
        }

        return $productDevice;
    }
}