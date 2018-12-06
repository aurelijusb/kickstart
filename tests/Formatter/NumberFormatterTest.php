<?php

namespace App\Services;

use App\Formatter\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    public function testFloatToString()
    {
        $numberFormatter = new NumberFormatter();
        $this->assertEquals('2.84M', $numberFormatter->floatToString(2835779));
        $this->assertEquals('1.00M', $numberFormatter->floatToString(999500));

        $this->assertEquals('535K', $numberFormatter->floatToString(535216));
        $this->assertEquals('100K', $numberFormatter->floatToString(99950));

        $this->assertEquals('27 534', $numberFormatter->floatToString(27533.78));

        $this->assertEquals('533.10', $numberFormatter->floatToString(533.1));
        $this->assertEquals('66.67', $numberFormatter->floatToString(66.6666));
        $this->assertEquals('12', $numberFormatter->floatToString(12.00));
        $this->assertEquals('12.01', $numberFormatter->floatToString(12.01));


        $this->assertEquals('-2.84M', $numberFormatter->floatToString(-2835779));
        $this->assertEquals('-1.00M', $numberFormatter->floatToString(-999500));

        $this->assertEquals('-535K', $numberFormatter->floatToString(-535216));
        $this->assertEquals('-100K', $numberFormatter->floatToString(-99950));

        $this->assertEquals('-27 534', $numberFormatter->floatToString(-27533.78));

        $this->assertEquals('-533.10', $numberFormatter->floatToString(-533.1));
        $this->assertEquals('-66.67', $numberFormatter->floatToString(-66.6666));
        $this->assertEquals('-12', $numberFormatter->floatToString(-12.00));
        $this->assertEquals('-12.01', $numberFormatter->floatToString(-12.01));
    }
}
