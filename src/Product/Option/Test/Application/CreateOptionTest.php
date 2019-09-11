<?php
declare(strict_types=1);

namespace CTIC\Product\Option\Test\Application;

use CTIC\Product\Option\Application\CreateOption;
use CTIC\Product\Option\Domain\Command\OptionCommand;
use CTIC\Product\Option\Domain\Option;
use PHPUnit\Framework\TestCase;

final class CreateOptionTest extends TestCase
{
    public function testCreateAssert()
    {
        $optionCommandRyu = new OptionCommand();
        $optionCommandRyu->name = 'ryu';
        $optionRyu = CreateOption::create($optionCommandRyu);

        $this->assertEquals(Option::class, get_class($optionRyu));
    }
}