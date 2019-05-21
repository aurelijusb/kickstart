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
     *
     */
    public function testFormatEur()
    {
        /** @var NumberFormatter|MockObject $numberFormatter */
        try {
            $numberFormatter = $this->createMock(NumberFormatter::class);
            $numberFormatter->expects($this->exactly(1))
                ->method('format')
                ->willReturn('2.84M');

            $moneyFormatter = new MoneyFormatter($numberFormatter);
            $this->assertEquals('2.84M €', $moneyFormatter->formatEur(2835779));
        } catch (ReflectionException $e) {
        }
    }

    /**
     *
     */
    public function testFormatUsd()
    {
        /** @var NumberFormatter|MockObject $numberFormatter */
        try {
            $numberFormatter = $this->createMock(NumberFormatter::class);
            $numberFormatter->expects($this->exactly(1))
                ->method('format')
                ->willReturn('-2.84M');

            $moneyFormatter = new MoneyFormatter($numberFormatter);
            $this->assertEquals('$-2.84M', $moneyFormatter->formatUsd(-2835779));
        } catch (ReflectionException $e) {
        }
    }
}
