<?php
namespace CTIC\Product\Option\Domain;

use CTIC\App\Company\Domain\Company;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\User\Domain\User;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface OptionInterface extends IdentifiableInterface, EntityInterface
{
    public function getName();
    public function getSlug();
    public function getTextTPV();
    public function getOrder();
    public function getParent();
    public function setParent(Option $option): bool;
    public function getCompany();
    public function setCompany(Company $company): bool;
    public function isEnabled();
}