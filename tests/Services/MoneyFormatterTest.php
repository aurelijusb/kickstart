<?php
namespace App\Tests\Services;

use App\Services\MoneyFormatter;
use App\Services\NumberFormater;

use PHPUnit\Framework\TestCase;

class MoneyFormatterTest extends TestCase
{

    public function testFormatEur()
    {
        $moneyFormatter = new MoneyFormatter(new NumberFormater());
//        $numberFormater = $this->createMock(NumberFormater::class);
//
//        $numberFormater->expects($this->exactly(1))->method('formatNumber')->willReturn();

        $this->assertEquals('2.84M €', $moneyFormatter->formatEur(2835779));
        $this->assertEquals('211.99 €', $moneyFormatter->formatEur(211.99));
        $this->assertEquals('$2.84M', $moneyFormatter->formatUsd(2835779));
        $this->assertEquals('$211.99', $moneyFormatter->formatUsd(211.99));
    }
}
