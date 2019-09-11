<?php
namespace CTIC\Product\Product\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Product\Product\Domain\Command\ProductObservationCommand;
use CTIC\Product\Product\Domain\Product;
use CTIC\Product\Product\Domain\ProductObservation;

class CreateProductObservation implements CreateInterface
{
    /**
     * @param CommandInterface|ProductObservationCommand $command
     * @return EntityInterface|ProductObservation
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $productObservation = new ProductObservation();
        $productObservation->setId($command->id);
        $productObservation->name = (empty($command->name))? '' : $command->name;
        $productObservation->observation = (empty($command->observation))? '' : $command->observation;
        if (!empty($command->product) && get_class($command->product) == Product::class) {
            $productObservation->setProduct($command->product);
        }

        return $productObservation;
    }
}