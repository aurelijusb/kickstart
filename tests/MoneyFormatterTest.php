<?php

namespace App\Tests;

use App\Services\MoneyFormatter;
use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class MoneyFormatterTest extends TestCase
{
    public function testFormatCurrencies()
    {
        /**
         * @var NumberFormatter|MockObject $currency
         */
        $currency = $this->createMock(NumberFormatter::class);
        $currency->expects($this->exactly(2))
            ->method('numberFormatter')
            ->willReturn('currency');

        $number = new MoneyFormatter($currency);
        $this->assertEquals('currency €', $number->formatEur(2835779));
        $this->assertEquals('$currency', $number->formatUsd(211.99));
    }

}
