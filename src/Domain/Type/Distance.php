<?php
declare(strict_types = 1);

namespace App\Domain\Type;

/**
 * Дистанция
 */
class Distance
{
    /**
     * путь
     *
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