<?php

namespace App\Tests;

use App\Formatter\MoneyFormatter;
use App\Formatter\NumberFormatter;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class MoneyFormatterTest extends TestCase
{
    //[expected, input]
    public function dataProviderFormatEur()
    {
        return [
          ['2.84M €', '2.84M'],
          ['1.00M €', '1.00M'],
          ['535K €', '535K'],
          ['100K €', '100K'],
          ['27 534 €', '27 534'],
          ['533.10 €', '533.10'],
          ['66.67 €', '66.67'],
          ['12 €', '12'],
          ['12.01 €', '12.01'],
          ['-2.84M €', '-2.84M'],
          ['-1.00M €', '-1.00M'],
          ['-535K €', '-535K'],
          ['-100K €', '-100K'],
          ['-27 534 €', '-27 534'],
          ['-533.10 €', '-533.10'],
          ['-66.67 €', '-66.67'],
          ['-12 €', '-12'],
          ['-12.01 €', '-12.01'],
          ['0 €', '0'],
        ];
    }

    //[expected, input]
    public function dataProviderFormatUsd()
    {
        return [
          ['$2.84M', '2.84M'],
          ['$1.00M', '1.00M'],
          ['$535K', '535K'],
          ['$100K', '100K'],
          ['$27 534', '27 534'],
          ['$533.10', '533.10'],
          ['$66.67', '66.67'],
          ['$12', '12'],
          ['$12.01', '12.01'],
          ['$-2.84M', '-2.84M'],
          ['$-1.00M', '-1.00M'],
          ['$-535K', '-535K'],
          ['$-100K', '-100K'],
          ['$-27 534', '-27 534'],
          ['$-533.10', '-533.10'],
          ['$-66.67', '-66.67'],
          ['$-12', '-12'],
          ['$-12.01', '-12.01'],
          ['$0', '0'],
          ['$', ''],
        ];
    }

    /**
     * @dataProvider dataProviderFormatEur
     */
    public function testFormatEur($expected, $input)
    {
        /** @var MockObject $numberFormatter */
        
        $numberFormatter = $this->createMock(NumberFormatter::class);
        
        $numberFormatter->method('floatToString')->willReturn($input);
        $moneyFormatter = new MoneyFormatter($numberFormatter);
        $this->assertEquals($expected, $moneyFormatter->formatEur());
    }


    /**
     * @dataProvider dataProviderFormatUsd
     */
    public function testFormatUsd($expected, $input)
    {
        /** @var MockObject $numberFormatter */

        $numberFormatter = $this->createMock(NumberFormatter::class);

        $numberFormatter->method('floatToString')->willReturn($input);
        $moneyFormatter = new MoneyFormatter($numberFormatter);
        $this->assertEquals($expected, $moneyFormatter->formatUsd());
    }
}
