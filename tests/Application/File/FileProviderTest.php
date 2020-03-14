<?php
declare(strict_types = 1);

namespace App\Tests\Application\File;

use App\Application\File\FileProvider;
use App\Domain\PathResearch;
use App\Domain\PotentialPath;
use App\Domain\Route\Instruction\InstructionCollection;
use App\Domain\Route\Instruction\TurnInstruction;
use App\Domain\Route\Instruction\WalkInstruction;
use App\Domain\Route\Route;
use App\Domain\Route\RoutePointer;
use App\Domain\Type\Degree;
use App\Domain\Type\Distance;
use App\Domain\Type\Location;
use PHPUnit\Framework\TestCase;

class FileProviderTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider dataProvider
     *
     * @param string  $path
     * @param array[] $expectedResult
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function output(string $path, array $expectedResult): void
    {
        $provider = new FileProvider($path);

        $actualResult = \iterator_to_array($provider->iterate());

        static::assertEquals($expectedResult, $actualResult);
        static::assertEquals(\count($expectedResult), \count($actualResult));
    }

    /**
     * @return array[]
     *
     * @throws \Throwable
     */
    public function dataProvider(): array
    {
        return [
            [
                __DIR__ . '/input.txt',
                [
                    new PathResearch([
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
                    ]),
                    new PathResearch([
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
                    ])
                ]
            ]
        ];
    }
}