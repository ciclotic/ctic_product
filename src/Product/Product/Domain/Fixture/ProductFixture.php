<?php
namespace CTIC\Product\Product\Domain\Fixture;

use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Company\Domain\Company;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Product\Product\Application\CreateProduct;
use CTIC\Product\Product\Domain\Command\ProductCommand;

class ProductFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {

    }
}