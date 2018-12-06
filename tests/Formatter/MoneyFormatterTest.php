<?php

namespace App\Tests;

use App\Formatter\MoneyFormatter;
use App\Formatter\NumberFormatter;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class MoneyFormatterTest extends TestCase
{

    public function testFormatEur()
    {
        /** @var MockObject $numberFormatter */
        
        $numberFormatter1 = $this->createMock(NumberFormatter::class);
        
        $numberFormatter1->method('floatToString')->willReturn('2.84M');
        $moneyFormatter = new MoneyFormatter($numberFormatter1);
        $this->assertEquals('2.84M €', $moneyFormatter->formatEur());

        $numberFormatter2 = $this->createMock(NumberFormatter::class);
        
        $numberFormatter2->method('floatToString')->willReturn('535K');
        $moneyFormatter = new MoneyFormatter($numberFormatter2);
        $this->assertEquals('535K €', $moneyFormatter->formatEur());

        $numberFormatter3 = $this->createMock(NumberFormatter::class);
        
        $numberFormatter3->method('floatToString')->willReturn('-2.84M');
        $moneyFormatter = new MoneyFormatter($numberFormatter3);
        $this->assertEquals('-2.84M €', $moneyFormatter->formatEur());
    }


    public function testFormatUsd()
    {
        /** @var MockObject $numberFormatter */

        $numberFormatter1 = $this->createMock(NumberFormatter::class);

        $numberFormatter1->method('floatToString')->willReturn('2.84M');
        $moneyFormatter = new MoneyFormatter($numberFormatter1);
        $this->assertEquals('$2.84M', $moneyFormatter->formatUsd());

        $numberFormatter2 = $this->createMock(NumberFormatter::class);

        $numberFormatter2->method('floatToString')->willReturn('535K');
        $moneyFormatter = new MoneyFormatter($numberFormatter2);
        $this->assertEquals('$535K', $moneyFormatter->formatUsd());

        $numberFormatter3 = $this->createMock(NumberFormatter::class);

        $numberFormatter3->method('floatToString')->willReturn('-2.84M');
        $moneyFormatter = new MoneyFormatter($numberFormatter3);
        $this->assertEquals('$-2.84M', $moneyFormatter->formatUsd());
    }
}
