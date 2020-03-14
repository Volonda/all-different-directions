<?php
declare(strict_types = 1);

namespace App\Tests\Domain;

use App\Application\FloatValueFormatter;
use App\Domain\PathResearch;
use App\Domain\Type\Distance;
use App\Domain\Type\Location;
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
     */
    public function output(PathResearch $collection, Location $expectedLocation, Distance $expectedDistance): void
    {
        #static::assertEquals($expectedLocation, $collection->averageDestination(), 'Check average distance');
        static::assertEquals(
            $expectedDistance,
            new Distance(FloatValueFormatter::twoDigits($collection->deviationLongestPath()->value())),
            'Check distance from average location'
        );
    }

    /**
     * @return array[]
     */
    public function dataProvider(): array
    {
        $generator = new StubPathResearchCaseGenerator();

        return \array_map(function($case)
        {
            return [
                $case['collection'],
                $case['location'],
                $case['destination']
            ];

        }, \iterator_to_array($generator->create()));
    }
}