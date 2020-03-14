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
     * @var float
     */
    private float $x;

    /**
     * Y axis coordinate
     *
     * @var float
     */
    private float $y;

    /**
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return float
     */
    public function x(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function y(): float
    {
        return $this->y;
    }
}