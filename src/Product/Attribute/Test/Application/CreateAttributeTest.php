<?php
declare(strict_types=1);

namespace CTIC\Product\Attribute\Test\Application;

use CTIC\Product\Attribute\Application\CreateAttribute;
use CTIC\Product\Attribute\Domain\Command\AttributeCommand;
use CTIC\Product\Attribute\Domain\Attribute;
use PHPUnit\Framework\TestCase;

final class CreateAttributeTest extends TestCase
{
    public function testCreateAssert()
    {
        $attributeCommandRyu = new AttributeCommand();
        $attributeCommandRyu->name = 'ryu';
        $attributeRyu = CreateAttribute::create($attributeCommandRyu);

        $this->assertEquals(Attribute::class, get_class($attributeRyu));
    }
}