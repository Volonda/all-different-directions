<?php
declare(strict_types = 1);

namespace App\Domain\Type;

/**
 * Location Value
 */
class Location
{
    /**
     * X axis coordinate
     *
     * @var FloatValue
     */
    private FloatValue $x;

    /**
     * Y axis coordinate
     *
     * @var FloatValue
     */
    private FloatValue $y;

    /**
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x, float $y)
    {
        $this->x = new FloatValue($x);
        $this->y = new FloatValue($y);;
    }

    /**
     * @return float
     */
    public function x(): float
    {
        return $this->x->value();
    }

    /**
     * @return float
     */
    public function y(): float
    {
        return $this->y->value();
    }
}