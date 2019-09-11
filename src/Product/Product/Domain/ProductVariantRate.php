<?php
namespace CTIC\Product\Product\Domain;

use CTIC\App\Rate\Domain\Rate;
use CTIC\Product\Product\Domain\Validation\ProductVariantRateValidation;
use Doctrine\ORM\Mapping as ORM;
use CTIC\App\Base\Domain\IdentifiableTrait;

/**
 * @ORM\Entity(repositoryClass="CTIC\Product\Product\Infrastructure\Repository\ProductVariantRateRepository")
 */
class ProductVariantRate implements ProductVariantRateInterface
{
    use IdentifiableTrait;
    use ProductVariantRateValidation;

    /**
     * @ORM\Column(type="float")
     *
     * @var float
     */
    public $pvp;

    /**
     * @ORM\Column(type="float")
     *
     * @var float
     */
    public $commission;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Rate\Domain\Rate")
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="id")
     *
     * @var Rate
     */
    private $rate = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Product\Product\Domain\ProductVariant", inversedBy="productVariantRate")
     * @ORM\JoinColumn(name="productvariant_id", referencedColumnName="id")
     *
     * @var ProductVariant
     */
    private $productVariant = null;

    /**
     * @return float
     */
    public function getPvp()
    {
        return $this->pvp;
    }

    /**
     * @return float
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * @return Rate
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param Rate $rate
     *
     * @return bool
     */
    public function setRate(Rate $rate): bool
    {
        if (get_class($rate) != Rate::class &&
            array_pop(class_parents($rate)) != Rate::class) {
            return false;
        }

        $this->rate = $rate;

        return true;
    }

    /**
     * @return ProductVariant
     */
    public function getProductVariant()
    {
        return $this->productVariant;
    }

    /**
     * @param ProductVariant $productVariant
     *
     * @return bool
     */
    public function setProductVariant(ProductVariant $productVariant): bool
    {
        if (get_class($productVariant) != ProductVariant::class &&
            array_pop(class_parents($productVariant)) != ProductVariant::class) {
            return false;
        }

        $this->productVariant = $productVariant;

        return true;
    }
}