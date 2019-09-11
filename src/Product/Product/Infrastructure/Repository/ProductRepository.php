<?php
namespace CTIC\Product\Product\Infrastructure\Repository;

use CTIC\Product\Product\Domain\Product;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

class ProductRepository extends EntityRepository
{
    /**
     * @return Product[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return Product
     *
     * @throws
     */
    public function findOneRandom(): Product
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var Product $product */
        $product = $qb->setMaxResults(1)->getOneOrNullResult();

        return $product;
    }
}