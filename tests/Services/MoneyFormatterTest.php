<?php

namespace App\Tests;

use App\Services\MoneyFormatter;
use App\Services\NumberFormatterInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class MoneyFormatterTest extends TestCase
{
    public function testFormat()
    {
       /** @var NumberFormatterInterface|MockObject $format */
        $format = $this->createMock(NumberFormatterInterface::class);
        $format->expects($this->exactly(2))
           ->method('format')
           ->willReturn('2.84M');

        $moneyFormatter = new MoneyFormatter($format);
        $this->assertEquals('2.84M €', $moneyFormatter->formatEur(2835779));
        $this->assertEquals('$2.84M', $moneyFormatter->formatUsd(2835779));
    }
}
