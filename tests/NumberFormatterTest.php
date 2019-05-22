<?php

namespace App\Tests;

use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    public function testValidNumber()
    {
        $numbers = new NumberFormatter();

        $this->assertEquals('2.84M', $numbers->numberFormatter(2835779));
        $this->assertEquals('1.00M', $numbers->numberFormatter(999500));
        $this->assertEquals('535K', $numbers->numberFormatter(535216));
        $this->assertEquals('100K', $numbers->numberFormatter(99950));
        $this->assertEquals('27 534', $numbers->numberFormatter(27533.78));
        $this->assertEquals('1 000', $numbers->numberFormatter(999.9999));
        $this->assertEquals('999.99', $numbers->numberFormatter(999.99));
        $this->assertEquals('533.10', $numbers->numberFormatter(533.1));
        $this->assertEquals('66.67', $numbers->numberFormatter(66.6666));
        $this->assertEquals('12.00', $numbers->numberFormatter(12));

        $this->assertEquals('-2.84M', $numbers->numberFormatter(-2835779));
        $this->assertEquals('-1.00M', $numbers->numberFormatter(-999500));
        $this->assertEquals('-535K', $numbers->numberFormatter(-535216));
        $this->assertEquals('-100K', $numbers->numberFormatter(-99950));
        $this->assertEquals('-27 534', $numbers->numberFormatter(-27533.78));
        $this->assertEquals('-1 000', $numbers->numberFormatter(-999.9999));
        $this->assertEquals('-999.99', $numbers->numberFormatter(-999.99));
        $this->assertEquals('-533.10', $numbers->numberFormatter(-533.1));
        $this->assertEquals('-66.67', $numbers->numberFormatter(-66.6666));
        $this->assertEquals('-12.00', $numbers->numberFormatter(-12));
    }
}
