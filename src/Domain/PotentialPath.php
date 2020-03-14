<?php
declare(strict_types = 1);

namespace App\Domain;

use App\Domain\Route\Route;
use App\Domain\Type\Human;
use App\Domain\Type\Location;

/**
 * Возможный маршрут
 */
class PotentialPath
{
    /**
     * @var Human
     */
    private Human $human;

    /**
     * @var Route
     */
    private Route $route;

    /** .
     * @param Human $human
     * @param Route $route
     */
    public function __construct(Human $human, Route $route)
    {
        $this->human = $human;
        $this->route = $route;
    }

    /**
     * @return Location
     */
    public function finalLocation(): Location
    {
        $this->proceedIfNeed();

        return $this->human->currentLocation();
    }

    /**
     * @return void
     */
    private function proceedIfNeed(): void
    {
        if(true === $this->human->hasArrived())
        {
            return;
        }

        $this->route->proceed($this->human);
    }
}