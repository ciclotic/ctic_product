<?php
namespace CTIC\Product\Product\Domain;

use CTIC\App\Company\Domain\Company;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\User\Domain\User;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface ProductInterface extends IdentifiableInterface, EntityInterface
{
    public function getName();
    public function getSlug();
    public function getDescription();
    public function getTextTPV();
    public function getSku();
    public function getOrder();
    public function getBarCode();
    public function isService();
    public function isEnabledDiscountClient();
    public function getIva();
    public function setIva(Iva $iva): bool;
    public function getUser();
    public function setUser(User $user): bool;
    public function getCompany();
    public function setCompany(Company $company): bool;
    public function getOption();
    public function setOption($option): bool;
    public function getAttribute();
    public function setAttribute($attribute): bool;
    public function getProductDevice();
    public function setProductDevice($productDevice): bool;
    public function getProductObservation();
    public function setProductObservation($productDevice): bool;
    public function getProductVariant();
    public function setProductVariant($productDevice): bool;
    public function isEnabled();
}