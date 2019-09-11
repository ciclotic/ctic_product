<?php
namespace CTIC\Product\Option\Infrastructure\Repository;

use CTIC\Product\Option\Domain\Option;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

class OptionRepository extends EntityRepository
{
    /**
     * @return Option[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return Option
     *
     * @throws
     */
    public function findOneRandom(): Option
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var Option $option */
        $option = $qb->setMaxResults(1)->getOneOrNullResult();

        return $option;
    }
}