<?php
namespace CTIC\Product\Attribute\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Product\Attribute\Domain\Command\AttributeCommand;
use CTIC\Product\Attribute\Domain\Attribute;
use CTIC\App\Company\Domain\Company;

class CreateAttribute implements CreateInterface
{
    /**
     * @param CommandInterface|AttributeCommand $command
     * @return EntityInterface|Attribute
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $attribute = new Attribute();
        $attribute->setId($command->id);
        $attribute->name = (empty($command->name))? '' : $command->name;
        $attribute->slug = (empty($command->slug))? '' : $command->slug;
        $attribute->textTPV = (empty($command->textTPV))? '' : $command->textTPV;
        $attribute->setType($command->type);
        $attribute->order = (empty($command->order))? '' : $command->order;
        $attribute->enabled = (empty($command->enabled))? false : true;
        if (!empty($command->company) && get_class($command->company) == Company::class) {
            $attribute->setCompany($command->company);
        }

        return $attribute;
    }
}