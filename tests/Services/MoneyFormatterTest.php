<?php

namespace App\Services\Tests;

use App\Services\MoneyFormatter;
use App\Services\NumberFormatterInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class MoneyFormatterTest
 * @package App\Services\Tests
 */
class MoneyFormatterTest extends TestCase
{

    public function testMoneyFormatting()
    {
        try{
            /** @var NumberFormatterInterface|MockObject $mock */
            $mock = $this->createMock(NumberFormatterInterface::class);
            $mock->expects($this->exactly(2))->method('formatNumber')->willReturn('2.84M');
            $moneyFormatter = new MoneyFormatter($mock);
            $this->assertEquals('2.84M €', $moneyFormatter->formatEur(2835779));
            $this->assertEquals('$2.84M', $moneyFormatter->formatUsd(2835779));
        }catch (\ReflectionException $e){}

    }

}
