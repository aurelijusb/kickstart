<?php

namespace App\Tests\Services;

use App\Services\MoneyFormatter;
use App\Services\NumberFormatter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MoneyFormatterTest extends TestCase
{
    /** @var NumberFormatter|MockObject */
    private $numberFormatter;

    /** @var MoneyFormatter */
    private $moneyFormatter;

    /**
     * @throws \ReflectionException
     */
    protected function setUp(): void
    {
        $this->numberFormatter = $this->createMock(NumberFormatter::class);
        $this->moneyFormatter = new MoneyFormatter($this->numberFormatter);
    }

    /**
     * @dataProvider getEurData
     * @param float $number
     * @param string $formatterNumb
     * @param string $expectedNumber
     */
    public function testFormatEur(float $number, string $formatterNumb, string $expectedNumber)
    {
        $this->numberFormatter->method('formatNumbers')->willReturn($formatterNumb);
        $money = $this->moneyFormatter->formatEur($number);

        $this->assertEquals($money, $expectedNumber);
    }

    /**
     * @dataProvider getUsdData
     * @param float $number
     * @param string $formatterNumb
     * @param string $expectedNumber
     */
    public function testFormatUsd(float $number, string $formatterNumb, string $expectedNumber)
    {
        $this->numberFormatter->method('formatNumbers')->willReturn($formatterNumb);
        $money = $this->moneyFormatter->formatUsd($number);

        $this->assertEquals($money, $expectedNumber);
    }

    /**
     * @return array
     */
    public function getEurData(): array
    {
        return [
            [
                1000000.00,
                '1.00M',
                '1.00M €'
            ],
            [
                1055890.00,
                '1.06M',
                '1.06M €'
            ],
            [
                1000055.00,
                '1.00M',
                '1.00M €'
            ],
            [
                5555555.00,
                '5.56M',
                '5.56M €'
            ],
            [
                999500.00,
                '1.00M',
                '1.00M €'
            ],
            [
                555555.00,
                '556K',
                '556K €'
            ],
            [
                99950.00,
                '100K',
                '100K €'
            ],
            [
                95261.555,
                '95 262',
                '95 262 €'
            ],
            [
                27533.78,
                '27 534',
                '27 534 €'
            ],
            [
                1000.78,
                '1 001',
                '1 001 €'
            ],
            [
                999.99,
                '999.99',
                '999.99 €'
            ],
            [
                525.9959,
                '526',
                '526 €'
            ],
            [
                211.10,
                '211.1',
                '211.1 €'
            ],
            [
                15.0000,
                '15',
                '15 €'
            ]
        ];
    }

    /**
     * @return array
     */
    public function getUsdData(): array
    {
        return [
            [
                1000000.00,
                '1.00M',
                '$1.00M'
            ],
            [
                1055890.00,
                '1.06M',
                '$1.06M'
            ],
            [
                1000055.00,
                '1.00M',
                '$1.00M'
            ],
            [
                5555555.00,
                '5.56M',
                '$5.56M'
            ],
            [
                999500.00,
                '1.00M',
                '$1.00M'
            ],
            [
                555555.00,
                '556K',
                '$556K'
            ],
            [
                99950.00,
                '100K',
                '$100K'
            ],
            [
                95261.555,
                '95 262',
                '$95 262'
            ],
            [
                27533.78,
                '27 534',
                '$27 534'
            ],
            [
                1000.78,
                '1 001',
                '$1 001'
            ],
            [
                999.99,
                '999.99',
                '$999.99'
            ],
            [
                525.9959,
                '526',
                '$526'
            ],
            [
                211.10,
                '211.1',
                '$211.1'
            ],
            [
                15.0000,
                '15',
                '$15'
            ]
        ];
    }

}
