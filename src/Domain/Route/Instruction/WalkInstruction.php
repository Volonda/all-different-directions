<?php
declare(strict_types = 1);

namespace App\Domain\Route\Instruction;

use App\Domain\Type\Distance;
use App\Domain\Type\Human;
use App\Domain\Type\Location;

/**
 * Инструкция двигаться
 */
final class WalkInstruction implements Instruction
{
    /**
     * @var Distance
     */
    private Distance $distance;

    /**
     * @param Distance $distance
     */
    public function __construct(Distance $distance)
    {
        $this->distance = $distance;
    }

    /**
     * @param Human $human
     */
    public function apply(Human $human): void
    {
        $currentLocation = $human->currentLocation();
        $curse = $human->currentCourse()->value();
        $distance = $this->distance->value();
        $radians = \deg2rad($curse);

        $x = $currentLocation->x();
        $x += $distance * \cos($radians);

        $y = $currentLocation->y();
        $y += $distance * \sin($radians);

        $human->moveToLocation(new Location($x, $y));
    }
}