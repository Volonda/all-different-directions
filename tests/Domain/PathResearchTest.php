<?php
declare(strict_types = 1);

namespace App\Tests\Domain;

use App\Domain\PathResearch;
use App\Domain\Type\Distance;
use App\Domain\Type\Location;
use App\Tests\Stub\StubPathResearchCaseGenerator;
use PHPUnit\Framework\TestCase;

class PathResearchTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider dataProvider
     *
     * @param PathResearch $collection
     * @param Location     $expectedLocation
     * @param Distance     $expectedDistance
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function output(PathResearch $collection, Location $expectedLocation, Distance $expectedDistance): void
    {
        static::assertEquals((string) $expectedLocation->x(), self::normalizeFloat($collection->averageDestination()->x()), 'Check average distance (X)');
        static::assertEquals((string) $expectedLocation->y(), self::normalizeFloat($collection->averageDestination()->y()), 'Check average distance (Y)');
        static::assertEquals((string) $expectedDistance->value(), self::normalizeFloat($collection->deviationLongestPath()->value()), 'Check distance from average location');
    }

    /**
     * @param float $value
     *
     * @return string
     *
     * @throws \Throwable
     */
    private static function normalizeFloat(float $value): string
    {
        return \sprintf('%.6g', $value);
    }

    /**
     * @return array[]
     *
     * @throws \Throwable
     */
    public function dataProvider(): array
    {

        return \array_map(function($case)
        {
            return [
                $case['collection'],
                $case['location'],
                $case['destination']
            ];

        }, StubPathResearchCaseGenerator::create());
    }
}