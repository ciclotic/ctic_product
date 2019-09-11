<?php
namespace CTIC\Product\Product\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Product\Product\Domain\Command\ProductCommand;
use CTIC\Product\Product\Domain\Product;
use CTIC\App\Company\Domain\Company;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\User\Domain\User;
use CTIC\Product\Product\Domain\ProductDevice;
use CTIC\Product\Product\Domain\ProductObservation;
use Doctrine\Common\Collections\ArrayCollection;

class CreateProduct implements CreateInterface
{
    /**
     * @param CommandInterface|ProductCommand $command
     * @return EntityInterface|Product
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $product = new Product();
        $product->setId($command->id);
        $product->name = (empty($command->name))? '' : $command->name;
        $product->sku = (empty($command->sku))? '' : $command->sku;
        $product->barCode = (empty($command->barCode))? '' : $command->barCode;
        $product->slug = (empty($command->slug))? '' : $command->slug;
        $product->description = (empty($command->description))? '' : $command->description;
        $product->textTPV = (empty($command->textTPV))? '' : $command->textTPV;
        $product->order = (empty($command->order))? '' : $command->order;
        $product->isService = (empty($command->isService))? '' : $command->isService;
        $product->enabledDiscountClient = (empty($command->enabledDiscountClient))? '' : $command->enabledDiscountClient;
        $product->enabled = (empty($command->enabled))? false : true;
        if (!empty($command->company) && get_class($command->company) == Company::class) {
            $product->setCompany($command->company);
        }
        if (!empty($command->user) && get_class($command->user) == User::class) {
            $product->setUser($command->user);
        }
        if (!empty($command->iva) && get_class($command->iva) == Iva::class) {
            $product->setIva($command->iva);
        }
        if (!empty($command->productDevice) && get_class($command->productDevice) == ArrayCollection::class) {
            $product->setProductDevice($command->productDevice);
        }
        if (!empty($command->productObservation) && get_class($command->productObservation) == ArrayCollection::class) {
            $product->setProductObservation($command->productObservation);
        }
        if (!empty($command->productVariant) && get_class($command->productVariant) == ArrayCollection::class) {
            $product->setProductVariant($command->productVariant);
        }
        if (!empty($command->option) && get_class($command->option) == ArrayCollection::class) {
            $product->setOption($command->option);
        }
        if (!empty($command->attribute) && get_class($command->attribute) == ArrayCollection::class) {
            $product->setAttribute($command->attribute);
        }

        return $product;
    }
}