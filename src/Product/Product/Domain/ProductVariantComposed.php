<?php
namespace CTIC\Product\Product\Domain;

use CTIC\Product\Product\Domain\Validation\ProductVariantComposedValidation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use CTIC\App\Base\Domain\IdentifiableTrait;

/**
 * @ORM\Entity(repositoryClass="CTIC\Product\Product\Infrastructure\Repository\ProductVariantComposedRepository")
 */
class ProductVariantComposed implements ProductVariantComposedInterface
{
    use IdentifiableTrait;
    use ProductVariantComposedValidation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $name;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Product\Product\Domain\ProductVariant", inversedBy="productVariantComposed")
     * @ORM\JoinColumn(name="productvariant_id", referencedColumnName="id")
     *
     * @var ProductVariant
     */
    private $productVariant = null;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Product\Product\Domain\ProductVariantComposedComplement", mappedBy="productVariantComposed", cascade={"persist", "remove"})
     *
     * @var ProductVariantComposedComplement[]
     */
    private $productVariantComposedComplement;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->productVariantComposedComplement = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * @return ProductVariantComposedComplement[]|ArrayCollection
     */
    public function getProductVariantComposedComplement()
    {
        return $this->productVariantComposedComplement;
    }

    /**
     * @param $productVariantComposedComplement
     * @return bool
     */
    public function setProductVariantComposedComplement($productVariantComposedComplement): bool
    {
        if (get_class($productVariantComposedComplement) != ArrayCollection::class) {
            return false;
        }

        $this->productVariantComposedComplement = $productVariantComposedComplement;

        return true;
    }
}