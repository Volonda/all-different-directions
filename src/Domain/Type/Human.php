<?php
declare(strict_types = 1);

namespace App\Domain\Type;

use App\Domain\Exception\DomainException;

/**
 * Человек
 */
class Human
{
    /**
     * @var Degree
     */
    private Degree $course;

    /**
     * @var Location
     */
    private Location $location;

    /**
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