<?php
declare(strict_types = 1);

namespace App\Domain\Type;

/**
 * Distance value
 */
class Distance
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
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }
}