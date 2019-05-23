<?php

declare(strict_types=1);

namespace App\Tests\Services;

use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    /** @var NumberFormatter */
    private $number;

    /**
     * @dataProvider getMillionData
     * @param float $number
     * @param string $expectedNumber
     */
    public function testNumberFormatter(float $number, string $expectedNumber): void
    {
        $this->assertEquals($this->number->formatNumbers($number), $expectedNumber);
    }

    /**
     * @return array
     */
    public function getMillionData(): array
    {
        return [
            [
                1000000.00,
                '1.00M'
            ],
            [
                1055890.00,
                '1.06M'
            ],
            [
                1000055.00,
                '1.00M'
            ],
            [
                5555555.00,
                '5.56M'
            ],
            [
                999500.00,
                '1.00M'
            ],
            [
                555555.00,
                '556K'
            ],
            [
                99950.00,
                '100K'
            ],
            [
                95261.555,
                '95 262'
            ],
            [
                27533.78,
                '27 534'
            ],
            [
                1000.78,
                '1 001'
            ],
            [
                999.99,
                '999.99'
            ],
            [
                525.9959,
                '526'
            ],
            [
                211.10,
                '211.1'
            ],
            [
                15.0000,
                '15'
            ],
            [
                -1000000.00,
                '-1.00M'
            ],
            [
                -1055890.00,
                '-1.06M'
            ],
            [
                -1000055.00,
                '-1.00M'
            ],
            [
                -5555555.00,
                '-5.56M'
            ],
            [
                -999500.00,
                '-1.00M'
            ],
            [
                -555555.00,
                '-556K'
            ],
            [
                -99950.00,
                '-100K'
            ],
            [
                -95261.555,
                '-95 262'
            ],
            [
                -27533.78,
                '-27 534'
            ],
            [
                -1000.78,
                '-1 001'
            ],
            [
                -999.99,
                '-999.99'
            ],
            [
                -525.9959,
                '-526'
            ],
            [
                -211.10,
                '-211.1'
            ],
            [
                -15.0000,
                '-15'
            ],
        ];
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->number = new NumberFormatter();
    }
}
