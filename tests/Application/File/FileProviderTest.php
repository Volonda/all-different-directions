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
use App\Tests\Stub\StubPathResearchCaseGenerator;
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
        $values = StubPathResearchCaseGenerator::create();

        return [
            [
                __DIR__ . '/../../Stub/input.txt',
                [
                    $values[0]['collection'],
                    $values[1]['collection']
                ]
            ]
        ];
    }
}