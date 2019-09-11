<?php
namespace CTIC\Product\Product\Infrastructure\Repository;

use CTIC\App\Base\Infrastructure\Repository\EntityRepository;
use CTIC\Product\Product\Domain\ProductVariantComposedComplement;

class ProductVariantComposedComplementRepository extends EntityRepository
{
    /**
     * @return ProductVariantComposedComplement[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return ProductVariantComposedComplement
     *
     * @throws
     */
    public function findOneRandom(): ProductVariantComposedComplement
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var ProductVariantComposedComplement $product */
        $product = $qb->setMaxResults(1)->getOneOrNullResult();

        return $product;
    }
}