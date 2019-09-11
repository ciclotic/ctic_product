<?php
namespace CTIC\Product\Attribute\Domain;

use CTIC\App\Company\Domain\Company;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\User\Domain\User;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface AttributeInterface extends IdentifiableInterface, EntityInterface
{
    const TYPE_GENERIC = 'generic';
    const TYPE_TEXT = 'text';
    const TYPE_BOOL = 'boolean';
    const TYPE_INT = 'integer';
    const TYPE_FLOAT = 'float';
    const TYPE_DATE = 'date';
    const TYPE_TIME = 'time';
    const TYPE_DATETIME = 'datetime';

    public function getName();
    public function getSlug();
    public function getTextTPV();
    public function getType();
    public function getOrder();
    public function getCompany();
    public function setCompany(Company $company): bool;
    public function isEnabled();
}