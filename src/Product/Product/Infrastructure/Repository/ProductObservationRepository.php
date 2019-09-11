<?php
namespace CTIC\Product\Product\Infrastructure\Repository;

use CTIC\App\Base\Infrastructure\Repository\EntityRepository;
use CTIC\Product\Product\Domain\ProductObservation;

class ProductObservationRepository extends EntityRepository
{
    /**
     * @return ProductObservation[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return ProductObservation
     *
     * @throws
     */
    public function findOneRandom(): ProductObservation
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var Product $product */
        $product = $qb->setMaxResults(1)->getOneOrNullResult();

        return $product;
    }
}