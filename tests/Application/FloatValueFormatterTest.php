<?php
declare(strict_types = 1);

namespace App\Tests\Application;

use App\Application\FloatValueFormatter;
use PHPUnit\Framework\TestCase;

class FloatValueFormatterTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider dataProvider
     *
     * @param float $value
     * @param float $expectedValue
     *
     * @return void
     */
    public function twoDigits(float $value, float $expectedValue): void
    {
        static::assertEquals(FloatValueFormatter::twoDigits($value), $expectedValue);
    }

    /**
     * @return array[]
     */
    public function dataProvider(): array
    {
        return [
            [1.00001, 1.00],
            [1.555, 1.56],
            [1.554, 1.55],
        ];
    }
}