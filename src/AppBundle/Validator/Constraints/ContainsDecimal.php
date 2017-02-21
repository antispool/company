<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsDecimal extends Constraint
{
    public $message = 'The decimal value: "%string%" not correct, out of range';
}