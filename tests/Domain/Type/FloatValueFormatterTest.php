<?php
declare(strict_types = 1);

namespace App\Tests\Domain\Type;

use App\Domain\Type\FloatValue;
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
    public function value(float $value, float $expectedValue): void
    {
        static::assertEquals($expectedValue, (new FloatValue($value))->value());
    }

    /**
     * @return array[]
     */
    public function dataProvider(): array
    {
        return [
            [1.000000001, 1.0000],
            [1.55555, 1.5556],
            [1.55554, 1.5555],
        ];
    }
}