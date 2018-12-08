<?php

namespace App\Tests;

use App\FormatterService\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{

    /**
     * @return array
     */
    public function providerNumber()
    {
        return [
            ["2.84M", 2835779],
            ["1.00M", 999500],
            ["535K", 535216],
            ["27 534", 27533.78],
            ["1 000",999.9999],
            ["999.99", 999.99],
            ["533.10",533.1],
            ["66.67",66.6666],
            ["12",12.00],
            ["-124K", -123654.89 ]


        ];
    }

    /**
     * @dataProvider providerNumber
     * @param $expectedNumber
     * @param $number
     */

    public function testNumber(string $expectedNumber, float $number)
    {
        $format=new NumberFormatter();
        $this->assertEquals($expectedNumber, $format->numberFormatter($number) );

    }


}
