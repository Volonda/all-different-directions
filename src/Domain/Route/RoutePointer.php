<?php
declare(strict_types = 1);

namespace App\Domain\Route;

use App\Domain\Exception\DomainException;
use App\Domain\Type\Degree;
use App\Domain\Type\Location;

/**
 * Object which moving by route
 */
class RoutePointer
{
    /**
     * Current course
     *
     * @var Degree
     */
    private Degree $course;

    /**
     * Current position
     *
     * @var Location
     */
    private Location $location;

    /**
     * State when object is reached a final location
     *
     * @var bool
     */
    private bool $hasArrived = false;

    /**
     * @param Location $location
     * @param Degree   $course
     */
    public function __construct(Location $location, Degree $course)
    {
        $this->course = $course;
        $this->location = $location;
    }

    /**
     * @param Location $location
     *
     * @throws DomainException
     */
    public function moveToLocation(Location $location): void
    {
        if(true === $this->hasArrived)
        {
            throw new DomainException('Ошибка изменения позиции. Маршрут завершен');
        }

        $this->location = $location;
    }

    /**
     * @param Degree $course
     *
     * @throws DomainException
     */
    public function changeCourse(Degree $course): void
    {
        if(true === $this->hasArrived)
        {
            throw new DomainException('Ошибка изменения курса. Маршрут завершен');
        }

        $this->course = $course;
    }

    /**
     * @return Degree
     */
    public function currentCourse(): Degree
    {
        return $this->course;
    }

    /**
     * @return Location
     */
    public function currentLocation(): Location
    {
        return $this->location;
    }

    /**
     * @return bool
     */
    public function hasArrived(): bool
    {
        return $this->hasArrived;
    }

    /**
     * @return void
     */
    public function makeHasArrived(): void
    {
        $this->hasArrived = true;
    }
}