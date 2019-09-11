<?php
namespace CTIC\Product\Product\Domain;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Product\Product\Domain\Validation\ProductDeviceValidation;
use CTIC\Device\Device\Domain\Device;
use CTIC\Product\Product\Domain\Product;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Product\Product\Infrastructure\Repository\ProductDeviceRepository")
 */
class ProductDevice implements ProductDeviceInterface
{
    use IdentifiableTrait;
    use ProductDeviceValidation;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @var string
     */
    public $name;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="CTIC\Product\Product\Domain\Product", inversedBy="productDevice")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     */
    public $product;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Device\Device\Domain\Device")
     * @ORM\JoinColumn(name="device_id", referencedColumnName="id")
     *
     * @var Device
     */
    private $device = null;

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
     * @return Device|null
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param Device $device
     *
     * @return bool
     */
    public function setDevice(Device $device): bool
    {
        if (get_class($device) != Device::class) {
            return false;
        }

        $this->device = $device;

        return true;
    }
}