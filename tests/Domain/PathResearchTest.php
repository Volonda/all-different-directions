<?php
declare(strict_types = 1);

namespace App\Tests\Domain;

use App\Domain\PotentialPath;
use App\Domain\PathResearch;
use App\Domain\Route\Instruction\InstructionCollection;
use App\Domain\Route\Instruction\TurnInstruction;
use App\Domain\Route\Instruction\WalkInstruction;
use App\Domain\Route\Route;
use App\Domain\Type\Degree;
use App\Domain\Type\Distance;
use App\Domain\Type\Human;
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
        static::assertEquals($expectedLocation, $collection->averageDestination(), 'Местоположения');
        static::assertEquals($expectedDistance, $collection->deviationLongestPath(), 'Дистанция');
    }

    /**
     * @return array[]
     */
    public function dataProvider(): array
    {
        $case1 = $this->createFirstInputCase();

        return [
            [
                $case1['collection'],
                $case1['location'],
                $case1['destination']
            ]
        ];
    }

    /**
     * input
     * 30 40 start 90 walk 5
     * 40 50 start 180 walk 10 turn 90 walk 5
     *
     * output
     * 30 45 0
     *
     * @return array
     */
    private static function createFirstInputCase(): array
    {
        $collection = new PathResearch([
            //30 40 start 90 walk 5
            new PotentialPath(
                new Human(
                    new Location(30, 40),
                    new Degree(90)
                ),
                new Route(new InstructionCollection([
                    new WalkInstruction(new Distance(5))
                ]))
            ),
            //40 50 start 180 walk 10 turn 90 walk 5
            new PotentialPath(
                new Human(
                    new Location(40, 50),
                    new Degree(180)
                ),
                new Route(new InstructionCollection([
                    new WalkInstruction(new Distance(10)),
                    new TurnInstruction(new Degree(90)),
                    new WalkInstruction(new Distance(5))
                ]))
            )
        ]);

        return [
            'collection'  => $collection,
            'location'    => new Location(30, 45),
            'destination' => new Distance(0)
        ];
    }
}