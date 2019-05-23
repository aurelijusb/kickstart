<?php

namespace App\Tests\Services;

use App\Services\MoneyFormatter;
use App\Services\NumberFormatter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MoneyFormatterTest extends TestCase
{
    public function numbersProvider()
    {
        return [
            //Teigiami skaičiai
            ['2.84M', 2835779],
            ['1.00M', 999500],
            ['535K', 535216],
            ['100K', 99950],
            ['27 534', 27533.78],
            ['999.99', 999.99],
            ['1 000', 999.9999],
            ['533.10', 533.1],
            ['66.67', 66.6666],
            ['12', 12],
            ['0', 0],
            //Neigiami skaičiai
            ['-2.84M', -2835779],
            ['-1.00M', -999500],
            ['-535K', -535216],
            ['-100K', -99950],
            ['-27 534', -27533.78],
            ['-999.99', -999.99],
            ['-1 000', -999.9999],
            ['-533.10', -533.1],
            ['-66.67', -66.6666],
            ['-12', -12],

        ];
    }

    /**
     * @formatUsdTest
     * @dataProvider numbersProvider
     */

    public function testFormatUsd($output, $input)
    {
        /**  @var NumberFormatter|MockObject $numberFormatter */
        $numberFormatter = $this->createMock(NumberFormatter::class);
        $numberFormatter->expects($this->exactly(1))->method('formatCurrency')->willReturn($output);

        $moneyFormatter = new MoneyFormatter($numberFormatter);

        $this->assertEquals('$' . $output, $moneyFormatter->formatUsd($input));

    }

    /**
     * @formatEurTest
     * @dataProvider numbersProvider
     */


    public function testFormatEur($output, $input)
    {
        /**  @var NumberFormatter|MockObject $numberFormatter */
        $numberFormatter = $this->createMock(NumberFormatter::class);
        $numberFormatter->expects($this->exactly(1))->method('formatCurrency')->willReturn($output);

        $moneyFormatter = new MoneyFormatter($numberFormatter);

        $this->assertEquals($output . ' €', $moneyFormatter->formatEur($input));

    }
}
