<?php
declare(strict_types = 1);

namespace App\Domain\Type;

/**
 * Float value with 2 digits after point
 */
class FloatValue
{
    /**
     * @var float
     */
    private float $value;

    /**
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = \round($value, 4);
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }
}