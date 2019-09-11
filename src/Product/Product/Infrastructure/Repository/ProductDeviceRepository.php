<?php
namespace CTIC\Product\Product\Infrastructure\Repository;

use CTIC\App\Base\Infrastructure\Repository\EntityRepository;
use CTIC\Product\Product\Domain\ProductDevice;

class ProductDeviceRepository extends EntityRepository
{
    /**
     * @return ProductDevice[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return ProductDevice
     *
     * @throws
     */
    public function findOneRandom(): ProductDevice
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var Product $product */
        $product = $qb->setMaxResults(1)->getOneOrNullResult();

        return $product;
    }
}