<?php
namespace CTIC\Product\Product\Infrastructure\Repository;

use CTIC\App\Base\Infrastructure\Repository\EntityRepository;
use CTIC\Product\Product\Domain\ProductVariantRate;

class ProductVariantRateRepository extends EntityRepository
{
    /**
     * @return ProductVariantRate[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return ProductVariantRate
     *
     * @throws
     */
    public function findOneRandom(): ProductVariantRate
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var ProductVariantRate $product */
        $product = $qb->setMaxResults(1)->getOneOrNullResult();

        return $product;
    }
}