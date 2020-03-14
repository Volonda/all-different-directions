<?php
declare(strict_types = 1);

namespace App\Domain\Type;

use App\Domain\Exception\DomainException;

/**
 * Float value with 4 digits after point
 *
 * Format taken from example https://open.kattis.com/problems/alldifferentdirections
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
        $formattedValue = \round($value, 4);

        if(false === $formattedValue)
        {
            throw new DomainException(\sprintf('Failed to convert float value %f to 4 digts after point', $value));
        }

        $this->value = $formattedValue;
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }
}