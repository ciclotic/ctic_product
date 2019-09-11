<?php
namespace CTIC\Product\Option\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Product\Option\Domain\Validation\OptionValidation;
use CTIC\App\Company\Domain\Company;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Product\Option\Infrastructure\Repository\OptionRepository")
 * @ORM\Table(name="ProductOption")
 */
class Option implements OptionInterface
{
    use IdentifiableTrait;
    use OptionValidation;

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
     * @ORM\ManyToOne(targetEntity="CTIC\Product\Option\Domain\Option")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     *
     * @var Option
     */
    private $parent = null;

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
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return Option|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Option $option
     *
     * @return bool
     */
    public function setParent(Option $option): bool
    {
        if (get_class($option) != Option::class) {
            return false;
        }

        $this->parent = $option;

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