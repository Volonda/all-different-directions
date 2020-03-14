<?php
declare(strict_types = 1);

namespace App\Tests\Application\File;

use App\Application\File\Row;
use App\Domain\Route\Instruction\InstructionCollection;
use App\Domain\Route\Instruction\TurnInstruction;
use App\Domain\Route\Instruction\WalkInstruction;
use App\Domain\Type\Degree;
use App\Domain\Type\Distance;
use App\Domain\Type\Location;
use PHPUnit\Framework\TestCase;

class RowTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider dataProvider
     *
     * @param string                $line
     * @param Location              $location
     * @param Degree                $course
     * @param InstructionCollection $instructions
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function output(string $line, Location $location, Degree $course, InstructionCollection $instructions): void
    {
        $row = new Row($line);

        static::assertEquals($location, $row->initialLocation(), 'Check parsed initial location');
        static::assertEquals($course, $row->initialCourse(), 'Check parsed initial course');
        static::assertEquals($instructions, $row->instructions(), 'Check parsed instructions');
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
                '2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60',
                new Location(2.6762, 75.2811),
                new Degree(-45.0),
                new InstructionCollection([
                    new WalkInstruction(new Distance(40)),
                    new TurnInstruction(new Degree(40.0)),
                    new WalkInstruction(new Distance(60)),
                ])
            ]
        ];
    }
}