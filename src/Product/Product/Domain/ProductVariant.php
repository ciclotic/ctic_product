<?php
namespace CTIC\Product\Product\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Product\Product\Domain\Validation\ProductVariantValidation;
use CTIC\Product\Product\Domain\Product;
use CTIC\App\RealizationArea\Domain\RealizationArea;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Product\Product\Infrastructure\Repository\ProductVariantRepository")
 */
class ProductVariant implements ProductVariantInterface
{
    use IdentifiableTrait;
    use ProductVariantValidation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @var string
     */
    public $slug;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    public $description;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $textTPV;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @var string
     */
    public $sku;

    /**
     * @ORM\Column(type="string", length=255, name="ordination")
     *
     * @var string
     */
    public $order;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     *
     * @var string
     */
    public $barCode;

    /**
     * @ORM\Column(type="float")
     *
     * @var float
     */
    public $minutes;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\RealizationArea\Domain\RealizationArea")
     * @ORM\JoinColumn(name="realizationarea_id", referencedColumnName="id")
     *
     * @var RealizationArea
     */
    private $realizationArea = null;

    /**
     * @ORM\Column(type="float")
     *
     * @var float
     */
    public $cost;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    public $stock;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    public $isComplement;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    public $hasComplement;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    public $enabled;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="CTIC\Product\Product\Domain\Product", inversedBy="productVariant")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     */
    public $product;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Product\Product\Domain\ProductVariantRate", mappedBy="productVariant", cascade={"persist", "remove"})
     *
     * @var ProductVariantRate[]
     */
    private $productVariantRate;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Product\Product\Domain\ProductVariantComposed", mappedBy="productVariant", cascade={"persist", "remove"})
     *
     * @var ProductVariantComposed[]
     */
    private $productVariantComposed;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->productVariantRate = new ArrayCollection();
        $this->productVariantComposed = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Product|null
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     *
     * @return bool
     */
    public function setProduct(Product $product): bool
    {
        if (get_class($product) != Product::class) {
            return false;
        }

        $this->product = $product;

        return true;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getTextTPV()
    {
        return $this->textTPV;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getBarCode()
    {
        return $this->barCode;
    }

    /**
     * @return float
     */
    public function getMinutes()
    {
        return $this->minutes;
    }

    /**
     * @return RealizationArea
     */
    public function getRealizationArea()
    {
        return $this->realizationArea;
    }

    /**
     * @param RealizationArea $realizationArea
     *
     * @return bool
     */
    public function setRealizationArea(RealizationArea $realizationArea): bool
    {
        if (get_class($realizationArea) != RealizationArea::class &&
            array_pop(class_parents($realizationArea)) != RealizationArea::class) {
            return false;
        }

        $this->realizationArea = $realizationArea;

        return true;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return bool
     */
    public function isStock()
    {
        return $this->stock;
    }

    /**
     * @return bool
     */
    public function isComplement()
    {
        return $this->isComplement;
    }

    /**
     * @return bool
     */
    public function isHasComplement()
    {
        return $this->hasComplement;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return ProductVariantRate[]|ArrayCollection
     */
    public function getProductVariantRate()
    {
        return $this->productVariantRate;
    }

    /**
     * @param $productVariantRate
     * @return bool
     */
    public function setProductVariantRate($productVariantRate): bool
    {
        if (get_class($productVariantRate) != ArrayCollection::class) {
            return false;
        }

        $this->productVariantRate = $productVariantRate;

        return true;
    }

    /**
     * @return ProductVariantComposed[]|ArrayCollection
     */
    public function getProductVariantComposed()
    {
        return $this->productVariantComposed;
    }

    /**
     * @param $productVariantComposed
     * @return bool
     */
    public function setProductVariantComposed($productVariantComposed): bool
    {
        if (get_class($productVariantComposed) != ArrayCollection::class) {
            return false;
        }

        $this->productVariantComposed = $productVariantComposed;

        return true;
    }
}