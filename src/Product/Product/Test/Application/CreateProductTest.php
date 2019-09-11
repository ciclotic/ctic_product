<?php
declare(strict_types=1);

namespace CTIC\Product\Product\Test\Application;

use CTIC\Product\Product\Application\CreateProduct;
use CTIC\Product\Product\Domain\Command\ProductCommand;
use CTIC\Product\Product\Domain\Product;
use PHPUnit\Framework\TestCase;

final class CreateProductTest extends TestCase
{
    public function testCreateAssert()
    {
        $productCommandRyu = new ProductCommand();
        $productCommandRyu->name = 'ryu';
        $productRyu = CreateProduct::create($productCommandRyu);

        $this->assertEquals(Product::class, get_class($productRyu));
    }
}