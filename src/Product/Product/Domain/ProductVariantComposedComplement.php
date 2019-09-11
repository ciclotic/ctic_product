<?php
namespace CTIC\Product\Product\Domain;

use CTIC\Product\Product\Domain\Validation\ProductVariantComposedComplementValidation;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\App\Base\Domain\IdentifiableTrait;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Product\Product\Infrastructure\Repository\ProductVariantComposedComplementRepository")
 */
class ProductVariantComposedComplement implements ProductVariantComposedComplementInterface
{
    use IdentifiableTrait;
    use ProductVariantComposedComplementValidation;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Product\Product\Domain\ProductVariant")
     * @ORM\JoinColumn(name="productvariant_id", referencedColumnName="id")
     *
     * @var ProductVariant
     */
    private $productVariant = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Product\Product\Domain\ProductVariantComposed", inversedBy="productVariantComposedComplement")
     * @ORM\JoinColumn(name="productvariantcomposed_id", referencedColumnName="id")
     *
     * @var ProductVariantComposed
     */
    private $productVariantComposed = null;

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

    /**
     * @return ProductVariantComposed
     */
    public function getProductVariantComposed()
    {
        return $this->productVariantComposed;
    }

    /**
     * @param ProductVariantComposed $productVariantComposed
     *
     * @return bool
     */
    public function setProductVariantComposed(ProductVariantComposed $productVariantComposed): bool
    {
        if (get_class($productVariantComposed) != ProductVariantComposed::class &&
            array_pop(class_parents($productVariantComposed)) != ProductVariantComposed::class) {
            return false;
        }

        $this->productVariantComposed = $productVariantComposed;

        return true;
    }
}