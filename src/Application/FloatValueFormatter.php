<?php
declare(strict_types = 1);

namespace App\Application;

use App\Domain\Type\Distance;
use App\Domain\Type\Location;

/**
 * Formatting float value
 */
class FloatValueFormatter
{
    private function __construct()
    {
    }

    /**
     * @param float $value
     *
     * @return float
     */
    public static function twoDigits(float $value) : float
    {
        return \round($value, 2);
    }
}