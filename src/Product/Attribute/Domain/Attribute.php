<?php
namespace CTIC\Product\Attribute\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Product\Attribute\Domain\Validation\AttributeValidation;
use CTIC\App\Company\Domain\Company;

/**
 * @ORM\Entity(repositoryClass="CTIC\Product\Attribute\Infrastructure\Repository\AttributeRepository")
 * @ORM\Table(name="ProductAttribute")
 */
class Attribute implements AttributeInterface
{
    use IdentifiableTrait;
    use AttributeValidation;

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
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $textTPV;

    /**
     * @ORM\Column(type="string", length=25)
     *
     * @var string
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=255, name="ordination")
     *
     * @var string
     */
    public $order;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    public $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Company\Domain\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *
     * @var Company
     */
    private $company = null;

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
    public function getTextTPV()
    {
        return $this->textTPV;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @var string $type
     *
     * @return bool
     */
    public function setType($type):bool
    {
        if ($type != self::TYPE_BOOL
            && $type != self::TYPE_DATE
            && $type != self::TYPE_DATETIME
            && $type != self::TYPE_TIME
            && $type != self::TYPE_INT
            && $type != self::TYPE_FLOAT
            && $type != self::TYPE_TEXT
            && $type != self::TYPE_GENERIC
        ) {
            return false;
        }

        $this->type = $type;

        return true;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
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
        if (get_class($company) != Company::class) {
            return false;
        }

        $this->company = $company;

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