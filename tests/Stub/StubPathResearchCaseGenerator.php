<?php
declare(strict_types = 1);

namespace App\Tests\Stub;

use App\Domain\PathResearch;
use App\Domain\PotentialPath;
use App\Domain\Route\RoutePointer;
use App\Domain\Route\Instruction\InstructionCollection;
use App\Domain\Route\Instruction\TurnInstruction;
use App\Domain\Route\Instruction\WalkInstruction;
use App\Domain\Route\Route;
use App\Domain\Type\Degree;
use App\Domain\Type\Distance;
use App\Domain\Type\Location;

/**
 * Cases from stub
 */
class StubPathResearchCaseGenerator
{
    private function __construct()
    {
    }

    /**
     * @return PathResearch[]
     *
     * @throws \Throwable
     */
    public static function create(): array
    {
        return [
          self::case1(),
          self::case2()
        ];
    }

    /**
     * input
     * 87.342 34.30 start 0 walk 10.0
     * 2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60
     * 58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5
     *
     * output
     * 97.1547 40.2334 7.63097
     *
     * @return array
     *
     * @throws \Throwable
     */
    private static function case1(): array
    {
        $collection = new PathResearch([
            //87.342 34.30 start 0 walk 10.0
            new PotentialPath(
                new RoutePointer(
                    new Location(87.342, 34.30),
                    new Degree(0)
                ),
                new Route(new InstructionCollection([
                    new WalkInstruction(new Distance(10.0))
                ])),
            ),
            //2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60
            new PotentialPath(
                new RoutePointer(
                    new Location(2.6762, 75.2811),
                    new Degree(-45.0)
                ),
                new Route(new InstructionCollection([
                    new WalkInstruction(new Distance(40)),
                    new TurnInstruction(new Degree(40.0)),
                    new WalkInstruction(new Distance(60))
                ]))
            ),
            //58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5
            new PotentialPath(
                new RoutePointer(
                    new Location(58.518, 93.508),
                    new Degree(270)
                ),
                new Route(new InstructionCollection([
                    new WalkInstruction(new Distance(50)),
                    new TurnInstruction(new Degree(90)),
                    new WalkInstruction(new Distance(40)),
                    new TurnInstruction(new Degree(13)),
                    new WalkInstruction(new Distance(5))
                ]))
            )
        ]);

        return [
            'collection'  => $collection,
            //97.1547 40.2334 7.63097
            'location'    => new Location(97.1547, 40.2334),
            'destination' => new Distance(7.63097)
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
     *
     * @throws \Throwable
     */
    private static function case2(): array
    {
        $collection = new PathResearch([
            //30 40 start 90 walk 5
            new PotentialPath(
                new RoutePointer(
                    new Location(30, 40),
                    new Degree(90)
                ),
                new Route(new InstructionCollection([
                    new WalkInstruction(new Distance(5))
                ]))
            ),
            //40 50 start 180 walk 10 turn 90 walk 5
            new PotentialPath(
                new RoutePointer(
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
            // 30 45 0
            'destination' => new Distance(0)
        ];
    }
}