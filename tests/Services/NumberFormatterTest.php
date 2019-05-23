<?php

namespace App\Tests;

use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    public function numberProvider()
    {
        return [
            ['2.84M', 2835779],
            ['1.00M', 999500],
            ['535K', 535216],
            ['100K', 99950],
            ['27 534', 27533.78],
            ['999.99', 999.99],
            ['1 000', 999.9999],
            ['533.10', 533.1],
            ['66.67', 66.6666],
            ['12.00', 12],
            ['-2.84M', -2835779],
            ['-1.00M', -999500],
            ['-535K', -535216],
            ['-100K', -99950],
            ['-27 534', -27533.78],
            ['-999.99', -999.99],
            ['-1 000', -999.9999],
            ['-533.10', -533.1],
            ['-66.67', -66.6666],
            ['-12.00', -12],
        ];
    }

    /**
     * @dataProvider numberProvider
     * @param $num1
     * @param $num2
     */
    public function testNumbers($num1, $num2)
    {
        $numberFormatter = new NumberFormatter($num1, $num2);

        $this->assertEquals($num1, $numberFormatter->format($num2));
    }
}
