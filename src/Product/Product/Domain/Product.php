<?php
namespace CTIC\Product\Product\Domain;

use CTIC\Product\Attribute\Domain\Attribute;
use CTIC\Product\Option\Domain\Option;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Product\Product\Domain\Validation\ProductValidation;
use CTIC\App\Company\Domain\Company;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\User\Domain\User;

/**
 * @ORM\Entity(repositoryClass="CTIC\Product\Product\Infrastructure\Repository\ProductRepository")
 */
class Product implements ProductInterface
{
    use IdentifiableTrait;
    use ProductValidation;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
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
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    public $isService;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    public $enabledDiscountClient;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    public $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\User\Domain\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var User
     */
    private $user = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Iva\Domain\Iva")
     * @ORM\JoinColumn(name="iva_id", referencedColumnName="id")
     *
     * @var Iva
     */
    private $iva = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Company\Domain\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *
     * @var Company
     */
    private $company = null;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Product\Product\Domain\ProductDevice", mappedBy="product", cascade={"persist", "remove"})
     *
     * @var ProductDevice[]
     */
    private $productDevice;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Product\Product\Domain\ProductObservation", mappedBy="product", cascade={"persist", "remove"})
     *
     * @var ProductObservation[]
     */
    private $productObservation;

    /**
     * @ORM\ManyToMany(targetEntity="CTIC\Product\Option\Domain\Option")
     *
     * @var Option[]
     */
    private $option;

    /**
     * @ORM\ManyToMany(targetEntity="CTIC\Product\Attribute\Domain\Attribute")
     *
     * @var Attribute[]
     */
    private $attribute;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Product\Product\Domain\ProductVariant", mappedBy="product", cascade={"persist", "remove"})
     *
     * @var ProductVariant[]
     */
    private $productVariant;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->option = new ArrayCollection();
        $this->attribute = new ArrayCollection();
        $this->productDevice = new ArrayCollection();
        $this->productObservation = new ArrayCollection();
        $this->productVariant = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
    public function getDescription()
    {
        return $this->description;
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
     * @return bool
     */
    public function isService()
    {
        return $this->isService;
    }

    /**
     * @return bool
     */
    public function isEnabledDiscountClient()
    {
        return $this->enabledDiscountClient;
    }

    /**
     * @return Iva|null
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * @param Iva $iva
     *
     * @return bool
     */
    public function setIva(Iva $iva): bool
    {
        if (get_class($iva) != Iva::class) {
            return false;
        }

        $this->iva = $iva;

        return true;
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function setUser(User $user): bool
    {
        if (get_class($user) != User::class) {
            return false;
        }

        $this->user = $user;

        return true;
    }

    /**
     * @return Company|null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     *
     * @return bool
     */
    public function setCompany(Company $company): bool
    {
        if (get_class($company) != Company::class &&
            array_pop(class_parents($company)) != Company::class) {
            return false;
        }

        $this->company = $company;

        return true;
    }

    /**
     * @return ProductDevice[]|ArrayCollection
     */
    public function getProductDevice()
    {
        return $this->productDevice;
    }

    /**
     * @param $productDevice
     * @return bool
     */
    public function setProductDevice($productDevice): bool
    {
        if (get_class($productDevice) != ArrayCollection::class) {
            return false;
        }

        $this->productDevice = $productDevice;

        return true;
    }

    /**
     * @return ProductObservation[]|ArrayCollection
     */
    public function getProductObservation()
    {
        return $this->productObservation;
    }

    /**
     * @param $productObservation
     * @return bool
     */
    public function setProductObservation($productObservation): bool
    {
        if (get_class($productObservation) != ArrayCollection::class) {
            return false;
        }

        $this->productObservation = $productObservation;

        return true;
    }

    /**
     * @return Option[]|ArrayCollection
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param $option
     * @return bool
     */
    public function setOption($option): bool
    {
        if (get_class($option) != ArrayCollection::class) {
            return false;
        }

        $this->option = $option;

        return true;
    }

    /**
     * @return Attribute[]|ArrayCollection
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param $attribute
     * @return bool
     */
    public function setAttribute($attribute): bool
    {
        if (get_class($attribute) != ArrayCollection::class) {
            return false;
        }

        $this->attribute = $attribute;

        return true;
    }

    /**
     * @return ProductVariant[]|ArrayCollection
     */
    public function getProductVariant()
    {
        return $this->productVariant;
    }

    /**
     * @param $productVariant
     * @return bool
     */
    public function setProductVariant($productVariant): bool
    {
        if (get_class($productVariant) != ArrayCollection::class) {
            return false;
        }

        $this->productVariant = $productVariant;

        return true;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}