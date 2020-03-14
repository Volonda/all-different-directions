<?php
declare(strict_types = 1);

namespace App\Domain;

use App\Domain\Route\Route;
use App\Domain\Route\RoutePointer;
use App\Domain\Type\Location;

/**
 * Possible route
 *
 * Path which needs to test
 */
class PotentialPath
{
    /**
     * @var RoutePointer
     */
    private RoutePointer $pointer;

    /**
     * @var Route
     */
    private Route $route;

    /** .
     * @param RoutePointer $pointer
     * @param Route        $route
     */
    public function __construct(RoutePointer $pointer, Route $route)
    {
        $this->pointer = $pointer;
        $this->route = $route;
    }

    /**
     * get route final location
     *
     * @return Location
     */
    public function finalLocation(): Location
    {
        $this->proceedIfNeed();

        return $this->pointer->currentLocation();
    }

    /**
     * compute route final location is need
     *
     * @return void
     */
    private function proceedIfNeed(): void
    {
        if(true === $this->pointer->hasArrived())
        {
            return;
        }

        $this->route->proceed($this->pointer);
    }
}