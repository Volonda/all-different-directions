<?php
declare(strict_types = 1);

namespace App\Tests\Application\File;

use App\Application\File\FileProvider;
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
        static::assertSameSize($expectedResult, $actualResult);
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