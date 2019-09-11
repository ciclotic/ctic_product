<?php
namespace CTIC\Product\Product\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface ProductObservationInterface extends IdentifiableInterface, EntityInterface
{
    public function getName();
    public function getProduct();
    public function setProduct(Product $device): bool;
    public function getObservation();
}