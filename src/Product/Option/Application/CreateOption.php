<?php
namespace CTIC\Product\Option\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Product\Option\Domain\Command\OptionCommand;
use CTIC\Product\Option\Domain\Option;
use CTIC\App\Company\Domain\Company;

class CreateOption implements CreateInterface
{
    /**
     * @param CommandInterface|OptionCommand $command
     * @return EntityInterface|Option
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $option = new Option();
        $option->setId($command->id);
        $option->name = (empty($command->name))? '' : $command->name;
        $option->slug = (empty($command->slug))? '' : $command->slug;
        $option->textTPV = (empty($command->textTPV))? '' : $command->textTPV;
        $option->order = (empty($command->order))? '' : $command->order;
        $option->enabled = (empty($command->enabled))? false : true;
        if (!empty($command->parent) && get_class($command->parent) == Option::class) {
            $option->setParent($command->parent);
        }
        if (!empty($command->company) && get_class($command->company) == Company::class) {
            $option->setCompany($command->company);
        }

        return $option;
    }
}