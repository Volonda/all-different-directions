<?php
declare(strict_types = 1);

namespace App\Domain\Route\Instruction;

use App\Domain\Type\Distance;
use App\Domain\Route\RoutePointer;
use App\Domain\Type\Location;

/**
 * Instruction to change location
 *
 * Calculating new location considering current course
 */
final class WalkInstruction implements Instruction
{
    /**
     * @var Distance
     */
    private Distance $distance;

    /**
     * @param Distance $distance - units to move
     */
    public function __construct(Distance $distance)
    {
        $this->distance = $distance;
    }

    /**
     * @param RoutePointer $pointer
     *
     * @throws \App\Domain\Exception\DomainException
     */
    public function apply(RoutePointer $pointer): void
    {
        $currentLocation = $pointer->currentLocation();
        $curse = $pointer->currentCourse()->value();
        $distance = $this->distance->value();
        $radians = \deg2rad($curse);

        $x = $currentLocation->x();
        $x += $distance * \cos($radians);

        $y = $currentLocation->y();
        $y += $distance * \sin($radians);

        $pointer->moveToLocation(new Location($x, $y));
    }
}