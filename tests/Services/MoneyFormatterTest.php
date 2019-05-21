<?php

namespace App\Tests\Services;

use App\Services\MoneyFormatter;
use App\Services\NumberFormatter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class MoneyFormatterTest extends TestCase
{
    /**
     * @return array
     */
    public function providerFormat()
    {
        return [
            ['2.84M', 2835779],
            ['1.00M', 999500],
            ['-2.84M', -2835779],
            ['-1.00M', -999500],
            ['283.58M', 283577901],
            ['-283.58M', -283577901],
            ['-124K', -123654.89],
            ['124K', 123654.89],
            ['-535K', -535216.9999],
            ['535K', 535216],
            ['100K', 99950],
            ['-100K', -99950],
            ['0', 0.00],
            ['27 534', 27533.78],
            ['1 000', 999.999999999999],
            ['999.99', 999.99],
            ['-27 534', -27533.78],
            ['-1 000', -999.999999999999],
            ['-999.99', -999.99],
            ['533.10', 533.1],
            ['-533.10', -533.102],
            ['533', 533.00],
            ['66.67',66.6666666 ]
        ];
    }

    /**
     * @dataProvider providerFormat
     * @param string $expectedFormat
     * @param float $numberToFormat
     */
    public function testFormatEur(string $expectedFormat, float $numberToFormat)
    {
        try {
            /** @var NumberFormatter|MockObject $numberFormatter */
            $numberFormatter = $this->createMock(NumberFormatter::class);
            $numberFormatter->expects($this->exactly(1))
                ->method('format')
                ->willReturn($expectedFormat);

            $moneyFormatter = new MoneyFormatter($numberFormatter);
            $this->assertEquals($expectedFormat.' €', $moneyFormatter->formatEur($numberToFormat));
        } catch (ReflectionException $e) {
        }
    }

    /**
     * @dataProvider providerFormat
     * @param string $expectedFormat
     * @param float $numberToFormat
     */
    public function testFormatUsd(string $expectedFormat, float $numberToFormat)
    {
        try {
            /** @var NumberFormatter|MockObject $numberFormatter */
            $numberFormatter = $this->createMock(NumberFormatter::class);
            $numberFormatter->expects($this->exactly(1))
                ->method('format')
                ->willReturn($expectedFormat);

            $moneyFormatter = new MoneyFormatter($numberFormatter);
            $this->assertEquals('$'.$expectedFormat, $moneyFormatter->formatUsd($numberToFormat));
        } catch (ReflectionException $e) {
        }
    }
}
