<?php
namespace CTIC\Product\Product\Infrastructure\Repository;

use CTIC\App\Base\Infrastructure\Repository\EntityRepository;
use CTIC\Product\Product\Domain\ProductVariant;

class ProductVariantRepository extends EntityRepository
{
    /**
     * @return ProductVariant[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return ProductVariant
     *
     * @throws
     */
    public function findOneRandom(): ProductVariant
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var ProductVariant $product */
        $product = $qb->setMaxResults(1)->getOneOrNullResult();

        return $product;
    }
}