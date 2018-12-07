<?php

namespace App\Services;

use App\Formatter\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{

    public function dataProviderFloatToString()
    {
        return [
            ['2.84M', 2835779],
            ['1.00M', 999500],
            ['535K', 535216],
            ['100K', 99950],
            ['27 534', 27533.78],
            ['533.10', 533.1],
            ['66.67', 66.6666],
            ['12', 12.00],
            ['12.01', 12.01],
            ['-2.84M', -2835779],
            ['-1.00M', -999500],
            ['-535K', -535216],
            ['-100K', -99950],
            ['-27 534', -27533.78],
            ['-533.10', -533.1],
            ['-66.67', -66.6666],
            ['-12', -12.00],
            ['-12.01', -12.01],
            ['0', 0],
        ];
    }


    /**
     * @dataProvider dataProviderFloatToString
     */
    public function testFloatToString($expected, $input)
    {
        $numberFormatter = new NumberFormatter();
        $this->assertEquals($expected, $numberFormatter->floatToString($input));
    }
}
