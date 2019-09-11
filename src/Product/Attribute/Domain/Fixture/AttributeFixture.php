<?php
namespace CTIC\Product\Attribute\Domain\Fixture;

use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Company\Domain\Company;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Product\Attribute\Application\CreateAttribute;
use CTIC\Product\Attribute\Domain\Command\AttributeCommand;

class AttributeFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {

    }
}