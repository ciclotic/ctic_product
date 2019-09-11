<?php
namespace CTIC\Product\Option\Domain\Fixture;

use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Company\Domain\Company;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Product\Option\Application\CreateOption;
use CTIC\Product\Option\Domain\Command\OptionCommand;

class OptionFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {

    }
}