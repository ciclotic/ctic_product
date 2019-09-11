<?php
namespace CTIC\Product\Attribute\Infrastructure\Repository;

use CTIC\Product\Attribute\Domain\Attribute;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

class AttributeRepository extends EntityRepository
{
    /**
     * @return Attribute[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return Attribute
     *
     * @throws
     */
    public function findOneRandom(): Attribute
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var Attribute $attribute */
        $attribute = $qb->setMaxResults(1)->getOneOrNullResult();

        return $attribute;
    }
}