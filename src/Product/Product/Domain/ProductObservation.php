<?php
namespace CTIC\Product\Product\Domain;

use Doctrine\ORM\Mapping as ORM;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Product\Product\Domain\Validation\ProductObservationValidation;
use CTIC\Product\Product\Domain\Product;

/**
 * @ORM\Entity(repositoryClass="CTIC\Product\Product\Infrastructure\Repository\ProductObservationRepository")
 */
class ProductObservation implements ProductObservationInterface
{
    use IdentifiableTrait;
    use ProductObservationValidation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $name;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    public $observation;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="CTIC\Product\Product\Domain\Product", inversedBy="productObservation")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     */
    public $product;

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
    public function getObservation()
    {
        return $this->observation;
    }
}