<?php
namespace CTIC\Product\Product\Domain\Validation;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

trait ProductVariantRateValidation
{
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
    }
}