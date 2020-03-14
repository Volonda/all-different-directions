<?php
declare(strict_types = 1);

namespace App\Domain;

use App\Domain\Type\Distance;
use App\Domain\Type\Location;

/**
 * Возможный маршрут
 */
class PathResearch
{
    /**
     * @var PotentialPath[]
     */
    private array $pathCollection;

    /**
     * @param array $pathCollection
     */
    public function __construct(array $pathCollection)
    {
        $this->pathCollection = $pathCollection;
    }

    /**
     * Среднее значение местонахождения после прохождения пути
     */
    public function averageDestination(): Location
    {
        $x = [];
        $y = [];

        /**
         * @var PotentialPath $potentialPath
         */
        foreach($this->pathCollection as $potentialPath)
        {
            $finalLocation = $potentialPath->finalLocation();

            $x[] = $finalLocation->x();
            $y[] = $finalLocation->y();
        }

        $count = \count($this->pathCollection);

        $averageX = \array_sum($x) / $count;
        $averageY = \array_sum($y) / $count;

        return new Location($averageX, $averageY);
    }

    /**
     * Отклонение самого неточного маршрута
     */
    public function deviationLongestPath(): Distance
    {
        $longestDistance = 0.0;
        $averageDestination = $this->averageDestination();

        /**
         * @var PotentialPath $potentialPath
         */
        foreach($this->pathCollection as $potentialPath)
        {
            $finaLocation = $potentialPath->finalLocation();

            $x = $averageDestination->x() - $finaLocation->x();
            $y = $averageDestination->y() - $finaLocation->y();

            $longestDistance = \max($longestDistance, \hypot($x, $y));
        }

        return new Distance($longestDistance);
    }
}