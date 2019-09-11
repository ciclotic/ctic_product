<?php
namespace CTIC\Product\Product\Infrastructure\Repository;

use CTIC\App\Base\Infrastructure\Repository\EntityRepository;
use CTIC\Product\Product\Domain\ProductVariantComposed;

class ProductVariantComposedRepository extends EntityRepository
{
    /**
     * @return ProductVariantComposed[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return ProductVariantComposed
     *
     * @throws
     */
    public function findOneRandom(): ProductVariantComposed
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var ProductVariantComposed $product */
        $product = $qb->setMaxResults(1)->getOneOrNullResult();

        return $product;
    }
}