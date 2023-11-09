<?php
namespace Fp\JsFormValidatorBundle\Form\Constraint;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as BaseUniqueEntity;

/**
 * Class UniqueEntity
 * @package Fp\JsFormValidatorBundle\Form\Constraint
 */
class UniqueEntity extends BaseUniqueEntity
{

    /**
     * @param BaseUniqueEntity $base
     * @param string|null $entityName
     */
    public function __construct(
        BaseUniqueEntity $base,
        public ?string $entityName = null
    )
    {
        foreach ($base as $prop => $value) {
            $this->{$prop} = $value;
        }
    }
} 